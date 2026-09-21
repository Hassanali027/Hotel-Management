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
            // charts (labels generated relative to today so they stay real)
            'revenues'         => $this->revenueSeries(),
            'reservationStats' => $this->reservationSeries(),
            'platforms'        => \App\Models\Platform::all(),
            'ratingCats'       => \App\Models\RatingCategory::all(),
        ]);
    }

    private function revenueSeries()
    {
        $amounts = \App\Models\Revenue::orderBy('id')->pluck('amount')->all();
        $n = count($amounts);
        $start = now()->startOfMonth()->subMonths($n - 1);
        $out = [];
        foreach ($amounts as $i => $amt) {
            $out[] = ['label' => $start->copy()->addMonths($i)->format('M Y'), 'amount' => (int) $amt];
        }
        return $out;
    }

    private function reservationSeries()
    {
        $rows = \App\Models\ReservationStat::orderBy('id')->get();
        $n = $rows->count();
        $start = now()->subDays($n - 1);
        $out = [];
        foreach ($rows as $i => $r) {
            $out[] = ['label' => $start->copy()->addDays($i)->format('j M'), 'booked' => (int) $r->booked, 'canceled' => (int) $r->canceled];
        }
        return $out;
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
        return view('reservation', ['bookings' => Booking::orderBy('id')->get()]);
    }

    public function bookingStore(Request $r)
    {
        $data = $r->validate([
            'guest_name'=>'required','room_type'=>'nullable','room_number'=>'nullable',
            'request'=>'nullable','duration'=>'nullable','check_in'=>'nullable','check_out'=>'nullable',
            'price_per_night'=>'nullable|integer','amount'=>'nullable|integer','status'=>'nullable',
        ]);
        $data['code'] = 'LG-B'.str_pad((Booking::max('id') + 108), 5, '0', STR_PAD_LEFT);
        $data['room_label'] = trim(($r->room_type ?? '').' '.($r->room_number ?? ''));
        $data['status'] = $r->status ?: 'pending';
        $data['invoice_status'] = $data['status'] === 'confirmed' ? 'paid' : 'unpaid';
        Booking::create($data);
        return back()->with('ok', 'Booking added');
    }

    public function bookingConfirm($id)
    {
        Booking::findOrFail($id)->update(['status' => 'confirmed', 'invoice_status' => 'paid']);
        return back();
    }

    public function bookingStatus($id, $status)
    {
        $allowed = ['pending', 'confirmed', 'checked_in', 'checked_out'];
        if (in_array($status, $allowed)) {
            $data = ['status' => $status];
            if ($status === 'confirmed') {
                $data['invoice_status'] = 'paid';
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
        ]);
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
        $b->update(['invoice_status' => $b->invoice_status === 'paid' ? 'unpaid' : 'paid']);
        return back();
    }

    public function invoiceDownload($id)
    {
        $booking = Booking::findOrFail($id);
        $nights = max(1, (int) preg_replace('/\D+/', '', (string) $booking->duration));
        $roomCharge = (float) $booking->amount;
        $vat = round($roomCharge * 0.08, 2);
        $cityTax = round($nights * 16.5, 2);
        $total = $roomCharge + $vat + $cityTax;
        $lines = [
            'INDUS RESORT RESTAURANT - INVOICE',
            '=================================',
            'Invoice No: '.$booking->code,
            'Date: '.now()->format('F j, Y'),
            'Bill To: '.$booking->guest_name,
            'Room: '.$booking->room_label,
            'Duration: '.$booking->duration,
            'Rate / night: PKR '.$booking->price_per_night,
            'Room charge: PKR '.number_format($roomCharge, 2),
            'VAT (8%): PKR '.number_format($vat, 2),
            'City tax: PKR '.number_format($cityTax, 2),
            'TOTAL: PKR '.number_format($total, 2),
            'Status: '.strtoupper($booking->invoice_status),
        ];
        return response($this->makeExpensePdf($lines, null), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="invoice-'.$booking->code.'.pdf"',
        ]);
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

    public function invReorder($id)
    {
        $i = InventoryItem::findOrFail($id);
        $i->update(['quantity_stock' => $i->quantity_stock + $i->quantity_reorder, 'availability' => 'available']);
        return back()->with('ok', 'Reordered');
    }

    public function invDestroy($id)
    {
        InventoryItem::findOrFail($id)->delete();
        return back();
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
        $guest = Guest::first();
        $booking = $request->filled('id')
            ? (Booking::find($request->id) ?: Booking::first())
            : (Booking::where('guest_name', $guest->name ?? '')->first() ?: Booking::first());
        if ($booking) {
            $guest = (clone $guest);
            $guest->name = $booking->guest_name;
        }
        $history = Booking::orderBy('id')->take(2)->get();
        return view('guest-profile', compact('guest', 'booking', 'history'));
    }
}
