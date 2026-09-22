<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Booking;
use App\Models\HousekeepingTask;
use App\Models\InventoryItem;
use App\Models\Schedule;
use App\Models\Expense;
use App\Models\Concierge;
use App\Models\Review;
use App\Models\Task;
use App\Models\Activity;

class PageController extends Controller
{
    /* ===================== DASHBOARD ===================== */
    public function dashboard()
    {
        $occupied  = (int) Room::sum('availability_used');
        $available = (int) Room::sum('availability_total') - $occupied;

        return view('Dashboard', [
            'bookings'     => Booking::orderBy('id')->take(5)->get(),
            'tasks'        => Task::all(),
            'activities'   => Activity::all(),
            // stat cards
            'newBookings'  => Booking::count(),
            'checkIn'      => Booking::where('status', 'checked_in')->count(),
            'checkOut'     => Booking::where('status', 'checked_out')->count(),
            'totalRevenue' => (int) Booking::where('invoice_status', 'paid')->sum('amount'),
            // room availability
            'occupied'     => $occupied,
            'available'    => $available,
            'reserved'     => Booking::count(),
            'notReady'     => HousekeepingTask::whereIn('status', ['needs', 'inspect'])->count(),
            // rating
            'ratingAvg'    => round((float) Review::avg('rating'), 1),
            'reviewCount'  => Review::count(),
            // Dashboard charts are calculated from actual booking records.
            'revenues'         => $this->revenueSeries(),
            'reservationStats' => $this->reservationSeries(),
            'platforms'        => \App\Models\Platform::all(),
            'ratingCats'       => \App\Models\RatingCategory::all(),
        ]);
    }

    private function revenueSeries()
    {
        $start = now()->startOfMonth()->subMonths(11);
        $bookings = Booking::whereIn('invoice_status', ['paid', 'partial'])->get();

        return collect(range(0, 11))->map(function ($offset) use ($start, $bookings) {
            $month = $start->copy()->addMonths($offset);
            $amount = $bookings->filter(function ($booking) use ($month) {
                $date = $booking->check_in ? \Carbon\Carbon::parse($booking->check_in) : $booking->created_at;
                return $date && $date->isSameMonth($month);
            })->sum(function ($booking) {
                $nights = max(1, (int) preg_replace('/\D+/', '', (string) $booking->duration));
                $total = (float) ($booking->amount ?: ((int) $booking->price_per_night * $nights));
                return $booking->invoice_status === 'paid'
                    ? $total
                    : min($total, (float) $booking->advance_amount);
            });

            return ['label' => $month->format('M Y'), 'amount' => (int) $amount];
        })->values()->all();
    }

    private function reservationSeries()
    {
        $start = now()->startOfDay()->subDays(6);
        $bookings = Booking::whereNotNull('check_in')->get();

        return collect(range(0, 6))->map(function ($offset) use ($start, $bookings) {
            $day = $start->copy()->addDays($offset);
            $forDay = $bookings->filter(fn ($booking) => \Carbon\Carbon::parse($booking->check_in)->isSameDay($day));
            return [
                'label' => $day->format('j M'),
                'booked' => $forDay->where('status', '!=', 'cancelled')->count(),
                'canceled' => $forDay->where('status', 'cancelled')->count(),
            ];
        })->values()->all();
    }

    public function taskStore(Request $r)
    {
        Task::create($r->validate(['title' => 'required', 'date' => 'nullable']));
        return back()->with('ok', 'Task added');
    }

    public function taskToggle($id)
    {
        $t = Task::findOrFail($id);
        $t->update(['done' => ! $t->done]);
        return back();
    }

    /* ===================== RESERVATION ===================== */
    public function reservation()
    {
        return view('reservation', [
            'bookings' => Booking::orderBy('id')->get(),
            'rooms' => Room::orderBy('name')->get(),
        ]);
    }

    public function bookingStore(Request $r)
    {
        $data = $r->validate([
            'guest_name'=>'required','cnic'=>'nullable|string|max:20','phone'=>'nullable|string|max:30','email'=>'nullable|email|max:255',
            'dob'=>'nullable|date','gender'=>'nullable|string|max:30','nationality'=>'nullable|string|max:100','passport_no'=>'nullable|string|max:100',
            'room_type'=>'nullable','room_number'=>'nullable',
            'request'=>'nullable','duration'=>'nullable','check_in'=>'nullable','check_out'=>'nullable',
            'price_per_night'=>'required|integer|min:1','amount'=>'nullable|integer','status'=>'nullable',
            'partial_payment'=>'nullable|boolean','advance_amount'=>'nullable|integer|min:0',
            'advance_receipt'=>'nullable|image|max:5120',
            'amenities'=>'nullable|array','amenity_notes'=>'nullable|string|max:500',
        ]);
        $data['partial_payment'] = $r->boolean('partial_payment');
        $data['advance_amount'] = (int) ($data['advance_amount'] ?? 0);
        $data['price_per_night'] = (int) $data['price_per_night'];
        $data['amount'] = (int) ($data['amount'] ?? 0);
        $data['amenities'] = json_encode($data['amenities'] ?? []);
        if ($r->hasFile('advance_receipt')) {
            $directory = public_path('uploads/booking-payments');
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
            $file = $r->file('advance_receipt');
            $name = 'advance_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($directory, $name);
            $data['advance_receipt_path'] = 'uploads/booking-payments/'.$name;
        }
        unset($data['advance_receipt']);
        $guest = Guest::updateOrCreate(
            ['name' => $data['guest_name']],
            [
                'phone' => $data['phone'] ?? null, 'email' => $data['email'] ?? null,
                'dob' => $data['dob'] ?? null, 'gender' => $data['gender'] ?? null,
                'nationality' => $data['nationality'] ?? null, 'passport_no' => $data['passport_no'] ?? null,
            ]
        );
        $data['guest_id'] = $guest->id;
        unset($data['phone'], $data['email'], $data['dob'], $data['gender'], $data['nationality'], $data['passport_no']);
        $data['code'] = 'LG-B'.str_pad((Booking::max('id') + 108), 5, '0', STR_PAD_LEFT);
        $data['room_label'] = trim(($r->room_type ?? '').' '.($r->room_number ?? ''));
        $data['status'] = $r->status ?: 'pending';
        $data['invoice_status'] = $data['partial_payment'] ? 'partial' : ($data['status'] === 'confirmed' ? 'paid' : 'unpaid');
        Booking::create($data);
        return back()->with('ok', 'Booking added');
    }

    public function bookingConfirm($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'confirmed', 'invoice_status' => $booking->partial_payment ? 'partial' : 'paid']);
        return back();
    }

    public function bookingStatus($id, $status)
    {
        $allowed = ['pending', 'confirmed', 'checked_in', 'checked_out'];
        if (in_array($status, $allowed)) {
            $data = ['status' => $status];
            if ($status === 'confirmed') {
                $booking = Booking::findOrFail($id);
                $data['invoice_status'] = $booking->partial_payment ? 'partial' : 'paid';
            }
            Booking::findOrFail($id)->update($data);
        }
        return back();
    }

    public function bookingDestroy($id)
    {
        Booking::findOrFail($id)->delete();
        return back();
    }

    /* ===================== ROOMS ===================== */
    public function rooms()
    {
        $rooms = Room::orderBy('id')->get();
        $featured = $rooms->firstWhere('is_featured', true) ?: $rooms->first();
        return view('rooms', compact('rooms', 'featured'));
    }

    public function roomStore(Request $r)
    {
        $data = $r->validate([
            'name'=>'required','status'=>'nullable','size'=>'nullable','bed'=>'nullable',
            'guests'=>'nullable','description'=>'nullable','price'=>'nullable|integer',
            'availability_used'=>'nullable|integer','availability_total'=>'nullable|integer',
            'features'=>'nullable|array','feature_bedrooms'=>'nullable|string|max:100','kitchen_feature'=>'nullable|string|max:100',
        ]);
        $features = $data['features'] ?? [];
        if (!empty($data['feature_bedrooms'])) {
            array_unshift($features, $data['feature_bedrooms']);
        }
        if (!empty($data['kitchen_feature'])) {
            $features[] = $data['kitchen_feature'];
        }
        $data['features'] = $features;
        unset($data['feature_bedrooms'], $data['kitchen_feature']);
        $paths = [];
        if ($r->hasFile('images')) {
            foreach ($r->file('images') as $file) {
                $name = 'room_'.time().'_'.mt_rand(1000, 9999).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $name);
                $paths[] = 'uploads/'.$name;
            }
        }
        $data['image'] = $paths[0] ?? 'images/room-info-hero.jpg';
        $data['gallery'] = $paths;
        Room::create($data);
        return back()->with('ok', 'Room added');
    }

    public function roomDestroy($id)
    {
        Room::findOrFail($id)->delete();
        return back();
    }

    /* ===================== INVOICE ===================== */
    public function invoice()
    {
        // An invoice becomes available only after the booking is confirmed.
        return view('invoice', ['bookings' => Booking::whereIn('status', ['confirmed', 'checked_in', 'checked_out'])->orderBy('id')->get()]);
    }

    public function invoiceToggle($id)
    {
        $b = Booking::findOrFail($id);
        $nights = max(1, (int) preg_replace('/\D+/', '', (string) $b->duration));
        $total = (float) ($b->amount ?: ((int) $b->price_per_night * $nights));
        $advance = min($total, (float) $b->advance_amount);

        if ($b->invoice_status === 'paid') {
            $b->update([
                'invoice_status' => $advance > 0 ? 'partial' : 'unpaid',
                'final_payment_amount' => 0,
                'final_payment_paid_at' => null,
            ]);
        } else {
            $b->update([
                'invoice_status' => 'paid',
                'final_payment_amount' => max(0, $total - $advance),
                'final_payment_paid_at' => now(),
            ]);
        }
        return back();
    }

    public function roomUpdate(Request $r, $id)
    {
        $room = Room::findOrFail($id);
        $data = $r->validate([
            'name'=>'required','status'=>'nullable','size'=>'nullable','bed'=>'nullable',
            'guests'=>'nullable','description'=>'nullable','price'=>'nullable|integer',
            'availability_used'=>'nullable|integer','availability_total'=>'nullable|integer',
            'features'=>'nullable|array','feature_bedrooms'=>'nullable|string|max:100','kitchen_feature'=>'nullable|string|max:100',
        ]);
        $features = $data['features'] ?? [];
        if (!empty($data['feature_bedrooms'])) {
            array_unshift($features, $data['feature_bedrooms']);
        }
        if (!empty($data['kitchen_feature'])) {
            $features[] = $data['kitchen_feature'];
        }
        $data['features'] = $features;
        unset($data['feature_bedrooms'], $data['kitchen_feature']);
        if ($r->hasFile('images')) {
            $paths = [];
            foreach ($r->file('images') as $file) {
                $name = 'room_'.time().'_'.mt_rand(1000, 9999).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $name);
                $paths[] = 'uploads/'.$name;
            }
            $data['image'] = $paths[0];
            $data['gallery'] = $paths;
        }
        $room->update($data);
        return back()->with('ok', 'Room updated');
    }

    public function invoiceDownload($id)
    {
        $booking = Booking::findOrFail($id);
        $nights = max(1, (int) preg_replace('/\D+/', '', (string) $booking->duration));
        $total = (float) ($booking->amount ?: ((int) $booking->price_per_night * $nights));
        $advance = min($total, (float) $booking->advance_amount);
        $finalPayment = $booking->invoice_status === 'paid'
            ? min(max(0, $total - $advance), (float) ($booking->final_payment_amount ?: ($total - $advance)))
            : 0;
        $remaining = max(0, $total - $advance - $finalPayment);
        return response($this->makeInvoicePdf($booking, $nights, $total, $advance, $finalPayment, $remaining), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="invoice-'.$booking->code.'.pdf"',
        ]);
    }

    private function makeInvoicePdf(Booking $booking, int $nights, float $total, float $advance, float $finalPayment, float $remaining): string
    {
        $escape = function ($value) {
            $value = preg_replace('/[^\x20-\x7E]/', '?', (string) $value);
            return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $value);
        };
        $text = function ($value, $x, $y, $size = 10, $font = 'F1') use ($escape) {
            return "BT /{$font} {$size} Tf 1 0 0 1 {$x} {$y} Tm (".$escape($value).') Tj ET';
        };
        $money = function ($value) {
            return 'PKR '.number_format($value, 0);
        };

        $stream = [];
        // Header and brand stripe.
        $stream[] = '0.92 0.98 0.51 rg 0 760 595 82 re f';
        $stream[] = '0.08 0.11 0.10 rg 42 748 511 1 re f';
        $stream[] = $text('INDUS RESORT RESTAURANT', 112, 810, 19);
        $stream[] = '0.25 0.31 0.18 rg';
        $stream[] = $text('Professional stay invoice', 112, 792, 9);
        $stream[] = $text('INVOICE', 447, 810, 17);
        $stream[] = $text('No. '.$booking->code, 447, 792, 9);

        // Guest and booking information.
        $stream[] = '0.96 0.98 0.97 rg 42 662 511 70 re f';
        $stream[] = '0.12 0.14 0.12 rg';
        $stream[] = $text('BILL TO', 56, 714, 8);
        $stream[] = $text($booking->guest_name, 56, 694, 13);
        $stream[] = $text('CNIC: '.($booking->cnic ?: '-'), 56, 677, 9);
        $stream[] = $text('BOOKING DETAILS', 320, 714, 8);
        $stream[] = $text('Room: '.($booking->room_label ?: '-'), 320, 694, 10);
        $stream[] = $text('Stay: '.$nights.' '.($nights === 1 ? 'night' : 'nights'), 320, 677, 9);
        $stream[] = $text('Invoice date: '.now()->format('d M Y'), 320, 662, 9);

        // Charge table.
        $stream[] = '0.20 0.32 0.24 rg 42 616 511 26 re f';
        $stream[] = '1 1 1 rg';
        $stream[] = $text('DESCRIPTION', 56, 625, 9);
        $stream[] = $text('RATE', 323, 625, 9);
        $stream[] = $text('NIGHTS', 405, 625, 9);
        $stream[] = $text('AMOUNT', 476, 625, 9);
        $stream[] = '0.98 0.99 0.98 rg 42 572 511 44 re f';
        $stream[] = '0.12 0.14 0.12 rg';
        $stream[] = $text('Accommodation - '.($booking->room_label ?: 'Room'), 56, 590, 10);
        $stream[] = $text($money($booking->price_per_night), 323, 590, 10);
        $stream[] = $text((string) $nights, 420, 590, 10);
        $stream[] = $text($money($total), 476, 590, 10);
        $stream[] = '0.87 0.91 0.88 RG 42 572 m 553 572 l S';

        // Payment history: preserves both the original advance and the later settlement.
        $balanceAfterAdvance = max(0, $total - $advance);
        $stream[] = '0.98 0.97 0.89 rg 306 398 247 148 re f';
        $stream[] = '0.78 0.71 0.39 RG 306 398 247 148 re S';
        $stream[] = '0.12 0.14 0.12 rg';
        $stream[] = $text('PAYMENT HISTORY', 322, 526, 10);
        $stream[] = $text('Total booking amount', 322, 506, 9);
        $stream[] = $text($money($total), 468, 506, 9);
        $stream[] = $text('Advance paid'.($advance > 0 ? ' - '.$booking->created_at->format('d M Y') : ''), 322, 485, 9);
        $stream[] = $text($money($advance), 468, 485, 9);
        $stream[] = $text('Balance after advance', 322, 464, 9);
        $stream[] = $text($money($balanceAfterAdvance), 468, 464, 9);
        $stream[] = $text('Final payment'.($finalPayment > 0 && $booking->final_payment_paid_at ? ' - '.\Carbon\Carbon::parse($booking->final_payment_paid_at)->format('d M Y') : ''), 322, 443, 9);
        $stream[] = $text($money($finalPayment), 468, 443, 9);
        $stream[] = '0.78 0.71 0.39 RG 322 430 m 537 430 l S';
        $stream[] = $text('REMAINING BALANCE', 322, 413, 10);
        $stream[] = $text($money($remaining), 455, 413, 12);

        $status = strtoupper($booking->invoice_status ?: 'unpaid');
        $stream[] = $status === 'PAID' ? '0.88 0.97 0.65 rg' : ($status === 'PARTIAL' ? '1 0.94 0.75 rg' : '1 0.88 0.88 rg');
        $stream[] = '42 490 210 36 re f';
        $stream[] = '0.12 0.14 0.12 rg';
        $stream[] = $text('PAYMENT STATUS: '.$status, 56, 503, 11);
        $stream[] = $text('Thank you for choosing Indus Resort Restaurant.', 42, 90, 10);
        $stream[] = '0.55 0.58 0.55 rg';
        $stream[] = $text('This is a computer-generated invoice.', 42, 72, 8);

        $jpeg = null;
        $imageWidth = $imageHeight = 0;
        $logoPath = public_path('images/logo.png');
        if (function_exists('imagecreatefromstring') && is_file($logoPath) && ($image = @imagecreatefromstring((string) file_get_contents($logoPath)))) {
            $imageWidth = imagesx($image);
            $imageHeight = imagesy($image);
            $scale = min(52 / $imageWidth, 52 / $imageHeight);
            $imageWidth = max(1, (int) round($imageWidth * $scale));
            $imageHeight = max(1, (int) round($imageHeight * $scale));
            $canvas = imagecreatetruecolor($imageWidth, $imageHeight);
            $white = imagecolorallocate($canvas, 255, 255, 255);
            imagefill($canvas, 0, 0, $white);
            imagecopyresampled($canvas, $image, 0, 0, 0, 0, $imageWidth, $imageHeight, imagesx($image), imagesy($image));
            ob_start();
            imagejpeg($canvas, null, 90);
            $jpeg = ob_get_clean();
            imagedestroy($canvas);
            imagedestroy($image);
            $stream[] = 'q '.$imageWidth.' 0 0 '.$imageHeight.' 50 778 cm /Im1 Do Q';
        }

        $stream = implode("\n", $stream);
        $resources = '<< /Font << /F1 5 0 R >>'.($jpeg ? ' /XObject << /Im1 6 0 R >>' : '').' >>';
        $objects = [
            '<< /Type /Catalog /Pages 2 0 R >>',
            '<< /Type /Pages /Kids [3 0 R] /Count 1 >>',
            '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources '.$resources.' /Contents 4 0 R >>',
            '<< /Length '.strlen($stream)." >>\nstream\n".$stream."\nendstream",
            '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>',
        ];
        if ($jpeg) {
            $objects[] = '<< /Type /XObject /Subtype /Image /Width '.$imageWidth.' /Height '.$imageHeight.' /ColorSpace /DeviceRGB /BitsPerComponent 8 /Filter /DCTDecode /Length '.strlen($jpeg)." >>\nstream\n".$jpeg."\nendstream";
        }
        $pdf = "%PDF-1.4\n";
        $offsets = [0];
        foreach ($objects as $index => $object) {
            $offsets[] = strlen($pdf);
            $pdf .= ($index + 1)." 0 obj\n".$object."\nendobj\n";
        }
        $xref = strlen($pdf);
        $pdf .= 'xref'."\n0 ".(count($objects) + 1)."\n0000000000 65535 f \n";
        foreach (array_slice($offsets, 1) as $offset) {
            $pdf .= sprintf('%010d 00000 n ', $offset)."\n";
        }
        return $pdf.'trailer'."\n<< /Size ".(count($objects) + 1)." /Root 1 0 R >>\nstartxref\n".$xref."\n%%EOF";
    }

    /* ===================== EXPENSES ===================== */
    public function expenses()
    {
        $expenses = Expense::orderBy('id')->get();
        $palette = ['Salaries and Wages'=>'#d2f3e4','Utilities'=>'#b6d8cb','Maintenance and Repairs'=>'#cbd877','Supplies'=>'#e8fb82','Marketing and Advertising'=>'#f4fac3','Miscellaneous'=>'#eefbf4'];
        $byCat = $expenses->groupBy('category')->map(function ($g) {
            return $g->sum('amount');
        })->sortDesc();
        $totalExpense = (int) $expenses->sum('amount');
        $totalIncome  = (int) Booking::where('invoice_status', 'paid')->sum('amount');
        $weekStart = now()->startOfWeek();
        $previousWeekStart = (clone $weekStart)->subWeek();
        $incomeFor = fn ($from, $to) => (int) Booking::where('invoice_status', 'paid')->whereBetween('check_in', [$from, $to])->sum('amount');
        $expenseFor = fn ($from, $to) => (int) Expense::whereBetween('date', [$from, $to])->sum('amount');
        $change = fn ($current, $previous) => $previous ? round((($current - $previous) / abs($previous)) * 100, 2) : ($current ? 100 : 0);
        $weekEnd = now()->endOfWeek();
        $previousWeekEnd = (clone $weekStart)->subDay();
        $weekIncome = $incomeFor($weekStart, $weekEnd);
        $weekExpense = $expenseFor($weekStart, $weekEnd);
        $previousIncome = $incomeFor($previousWeekStart, $previousWeekEnd);
        $previousExpense = $expenseFor($previousWeekStart, $previousWeekEnd);
        $year = now()->year;
        $earnings = collect(range(1, 12))->map(function ($month) use ($year) {
            return [
                'month' => now()->setDate($year, $month, 1)->format('M'),
                'income' => (int) Booking::where('invoice_status', 'paid')->whereYear('check_in', $year)->whereMonth('check_in', $month)->sum('amount'),
                'expense' => (int) Expense::whereYear('date', $year)->whereMonth('date', $month)->sum('amount'),
            ];
        })->values();
        $chartMax = max(1000, (int) ceil($earnings->flatMap(fn ($month) => [$month['income'], $month['expense']])->max() / 1000) * 1000);

        $cats = [];
        foreach ($byCat as $name => $amt) {
            $cats[] = [
                'name'    => $name,
                'amount'  => (int) $amt,
                'percent' => $totalExpense ? round($amt / $totalExpense * 100, 2) : 0,
                'color'   => $palette[$name] ?? '#d2f3e4',
            ];
        }
        $incomeCats = [];
        $incomeByCategory = Booking::where('invoice_status', 'paid')->get()->groupBy(fn ($booking) => $booking->room_type ?: 'Other')->map(fn ($group) => $group->sum('amount'))->sortDesc();
        foreach ($incomeByCategory as $name => $amount) {
            $incomeCats[] = [
                'name' => $name,
                'amount' => (int) $amount,
                'percent' => $totalIncome ? round($amount / $totalIncome * 100, 2) : 0,
                'color' => $palette[$name] ?? ['#d2f3e4', '#b6d8cb', '#cbd877', '#e8fb82'][count($incomeCats) % 4],
            ];
        }

        return view('expenses', [
            'expenses'     => $expenses,
            'cats'         => $cats,
            'incomeCats'   => $incomeCats,
            'totalExpense' => $totalExpense,
            'totalIncome'  => $totalIncome,
            'totalBalance' => $totalIncome - $totalExpense,
            'balanceChange' => $change($weekIncome - $weekExpense, $previousIncome - $previousExpense),
            'incomeChange' => $change($weekIncome, $previousIncome),
            'expenseChange' => $change($weekExpense, $previousExpense),
            'earnings' => $earnings,
            'chartMax' => $chartMax,
            'chartYear' => $year,
        ]);
    }

    public function expenseStore(Request $r)
    {
        $data = $r->validate([
            'name'=>'required','category'=>'nullable','custom_category'=>'nullable|string|max:255','quantity'=>'nullable|integer',
            'amount'=>'nullable|integer','date'=>'nullable','receipt'=>'nullable|image|max:5120',
        ]);

        if (filled($data['custom_category'] ?? null)) {
            $data['category'] = $data['custom_category'];
        }
        unset($data['custom_category']);

        if ($r->hasFile('receipt')) {
            $directory = public_path('uploads/expenses');
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
            $file = $r->file('receipt');
            $name = 'expense_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($directory, $name);
            $data['receipt_path'] = 'uploads/expenses/'.$name;
        }

        unset($data['receipt']);
        Expense::create($data + ['status' => 'completed']);
        return back()->with('ok', 'Expense added');
    }

    public function expenseDestroy($id)
    {
        Expense::findOrFail($id)->delete();
        return back();
    }

    public function expenseDownload($id)
    {
        $expense = Expense::findOrFail($id);
        $lines = [
            'INDUS RESORT RESTAURANT EXPENSE',
            '================================',
            'Expense: '.$expense->name,
            'Category: '.($expense->category ?: '-'),
            'Quantity: '.$expense->quantity,
            'Amount: PKR '.$expense->amount,
            'Date: '.($expense->date ?: '-'),
        ];

        $receiptPath = $expense->receipt_path ? public_path($expense->receipt_path) : null;
        return response($this->makeExpensePdf($lines, $receiptPath), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="expense-'.$expense->id.'.pdf"',
        ]);
    }

    private function makeExpensePdf(array $lines, ?string $receiptPath): string
    {
        $text = ['BT', '/F1 16 Tf', '50 790 Td'];
        foreach ($lines as $index => $line) {
            if ($index) {
                $text[] = '0 -20 Td';
            }
            $line = preg_replace('/[^\x20-\x7E]/', '?', (string) $line);
            $text[] = '('.str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $line).') Tj';
        }

        $text[] = 'ET';
        $jpeg = null;
        $imageWidth = $imageHeight = 0;
        if ($receiptPath && is_file($receiptPath) && ($image = @imagecreatefromstring((string) file_get_contents($receiptPath)))) {
            $sourceWidth = imagesx($image);
            $sourceHeight = imagesy($image);
            $scale = min(440 / $sourceWidth, 360 / $sourceHeight, 1);
            $imageWidth = round($sourceWidth * $scale);
            $imageHeight = round($sourceHeight * $scale);
            ob_start();
            imagejpeg($image, null, 85);
            $jpeg = ob_get_clean();
            imagedestroy($image);
            $text[] = 'q '.$imageWidth.' 0 0 '.$imageHeight.' 50 80 cm /Im1 Do Q';
        }
        $stream = implode("\n", $text);

        $resources = '<< /Font << /F1 5 0 R >>'.($jpeg ? ' /XObject << /Im1 6 0 R >>' : '').' >>';
        $objects = [
            '<< /Type /Catalog /Pages 2 0 R >>',
            '<< /Type /Pages /Kids [3 0 R] /Count 1 >>',
            '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources '.$resources.' /Contents 4 0 R >>',
            '<< /Length '.strlen($stream)." >>\nstream\n".$stream."\nendstream",
            '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>',
        ];
        if ($jpeg) {
            $objects[] = '<< /Type /XObject /Subtype /Image /Width '.$imageWidth.' /Height '.$imageHeight.' /ColorSpace /DeviceRGB /BitsPerComponent 8 /Filter /DCTDecode /Length '.strlen($jpeg)." >>\nstream\n".$jpeg."\nendstream";
        }

        $pdf = "%PDF-1.4\n";
        $offsets = [0];
        foreach ($objects as $index => $object) {
            $offsets[] = strlen($pdf);
            $pdf .= ($index + 1)." 0 obj\n".$object."\nendobj\n";
        }
        $xref = strlen($pdf);
        $pdf .= 'xref'."\n0 ".(count($objects) + 1)."\n0000000000 65535 f \n";
        foreach (array_slice($offsets, 1) as $offset) {
            $pdf .= sprintf('%010d 00000 n ', $offset)."\n";
        }
        return $pdf.'trailer'."\n<< /Size ".(count($objects) + 1)." /Root 1 0 R >>\nstartxref\n".$xref."\n%%EOF";
    }

    /* ===================== CONCIERGE ===================== */
    public function concierge()
    {
        return view('concierge', ['concierges' => Concierge::orderBy('id')->get()]);
    }

    public function conciergeStore(Request $r)
    {
        $data = $r->validate([
            'name'=>'required','position'=>'nullable','schedule_days'=>'nullable',
            'schedule_time'=>'nullable','contact'=>'nullable','email'=>'nullable',
        ]);
        $data['code'] = 'ELG'.str_pad((Concierge::max('id') + 1), 3, '0', STR_PAD_LEFT);
        $data['status'] = 'active';
        Concierge::create($data);
        return back()->with('ok', 'Concierge added');
    }

    public function conciergeDestroy($id)
    {
        Concierge::findOrFail($id)->delete();
        return back();
    }

    /* ===================== HOUSEKEEPING ===================== */
    public function housekeeping()
    {
        return view('housekeeping', ['rows' => HousekeepingTask::orderBy('id')->get()]);
    }

    public function hkStore(Request $r)
    {
        HousekeepingTask::create($r->validate([
            'room_number'=>'required','room_type'=>'nullable','status'=>'nullable',
            'priority'=>'nullable','floor'=>'nullable','reservation_status'=>'nullable','notes'=>'nullable',
        ]));
        return back()->with('ok', 'Room added');
    }

    public function hkUpdate(Request $r, $id)
    {
        $t = HousekeepingTask::findOrFail($id);
        $t->update($r->only(['status', 'priority', 'is_checked']));
        return back();
    }

    public function hkDestroy($id)
    {
        HousekeepingTask::findOrFail($id)->delete();
        return back();
    }

    /* ===================== INVENTORY ===================== */
    public function inventory()
    {
        return view('inventory', ['items' => InventoryItem::orderBy('id')->get()]);
    }

    public function invStore(Request $r)
    {
        $data = $r->validate([
            'name'=>'required','category'=>'nullable','availability'=>'nullable','image'=>'nullable|image|max:5120',
            'quantity_stock'=>'nullable|integer','quantity_reorder'=>'nullable|integer',
        ]);
        if ($r->hasFile('image')) {
            $directory = public_path('uploads/inventory');
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
            $file = $r->file('image');
            $name = 'inventory_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($directory, $name);
            $data['image_path'] = 'uploads/inventory/'.$name;
        }
        unset($data['image']);
        InventoryItem::create($data);
        return back()->with('ok', 'Item added');
    }

    public function invAddStock(Request $r, $id)
    {
        $i = InventoryItem::findOrFail($id);
        $data = $r->validate(['quantity' => 'required|integer|min:1']);
        $stock = $i->quantity_stock + $data['quantity'];
        $availability = $stock <= 0 ? 'out' : ($stock < $i->quantity_reorder ? 'low' : 'available');
        $i->update(['quantity_stock' => $stock, 'availability' => $availability]);
        return back()->with('ok', 'Stock added successfully');
    }

    public function invDestroy($id)
    {
        InventoryItem::findOrFail($id)->delete();
        return back()->with('ok', 'Item deleted successfully');
    }

    /* ===================== CALENDAR ===================== */
    public function calendar()
    {
        return view('calendar', ['schedules' => Schedule::orderBy('date')->get()]);
    }

    public function scheduleStore(Request $r)
    {
        Schedule::create($r->validate([
            'title'=>'required','category'=>'nullable','date'=>'required',
            'start_time'=>'nullable','end_time'=>'nullable',
        ]));
        return back()->with('ok', 'Schedule added');
    }

    /* ===================== REVIEWS ===================== */
    public function reviews()
    {
        return view('reviews', ['reviews' => Review::orderBy('id')->get()]);
    }

    /* ===================== GUEST PROFILE ===================== */
    public function guestProfile(Request $request)
    {
        $booking = $request->filled('id')
            ? (Booking::find($request->id) ?: Booking::first())
            : Booking::first();
        $guest = $booking && $booking->guest_id ? Guest::find($booking->guest_id) : null;
        if (!$guest && $booking) {
            $guest = Guest::where('name', $booking->guest_name)->first();
        }
        if (!$guest) {
            $guest = new Guest(['name' => $booking ? $booking->guest_name : 'Guest']);
        }
        $history = Booking::orderBy('id')->take(2)->get();
        $room = $booking ? Room::where('name', $booking->room_type)->first() : null;
        return view('guest-profile', compact('guest', 'booking', 'history', 'room'));
    }
}
