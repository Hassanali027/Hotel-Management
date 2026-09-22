<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomUnit;
use App\Models\InventoryMovement;
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
        // Room figures come from the room-number list when it exists (older data falls back to the manual counts).
        $hasUnits  = RoomUnit::count() > 0;
        $occupied  = $hasUnits ? RoomUnit::where('status', 'occupied')->count() : (int) Room::sum('availability_used');
        $available = $hasUnits ? RoomUnit::where('status', 'available')->count() : (int) Room::sum('availability_total') - $occupied;
        $reservedRooms = $hasUnits ? RoomUnit::where('status', 'reserved')->count() : Booking::count();
        $notReadyRooms = $hasUnits ? RoomUnit::where('status', 'not_ready')->count() : HousekeepingTask::whereIn('status', ['needs', 'inspect'])->count();

        // Week-over-week change for the stat cards (this week vs. the 7 days before).
        $weekStart = now()->startOfDay()->subDays(6);
        $prevStart = $weekStart->copy()->subDays(7);
        $pct = function ($now, $before) {
            if ($before <= 0) {
                return $now > 0 ? 100.0 : 0.0;
            }
            return round(($now - $before) / $before * 100, 2);
        };
        $count = fn ($q) => (int) $q->count();
        $bookingsNow  = $count(Booking::where('created_at', '>=', $weekStart));
        $bookingsPrev = $count(Booking::whereBetween('created_at', [$prevStart, $weekStart]));
        $checkInNow   = $count(Booking::where('status', 'checked_in')->where('updated_at', '>=', $weekStart));
        $checkInPrev  = $count(Booking::where('status', 'checked_in')->whereBetween('updated_at', [$prevStart, $weekStart]));
        $checkOutNow  = $count(Booking::where('status', 'checked_out')->where('updated_at', '>=', $weekStart));
        $checkOutPrev = $count(Booking::where('status', 'checked_out')->whereBetween('updated_at', [$prevStart, $weekStart]));
        $revNow  = (int) Booking::where('invoice_status', 'paid')->where('updated_at', '>=', $weekStart)->sum('amount');
        $revPrev = (int) Booking::where('invoice_status', 'paid')->whereBetween('updated_at', [$prevStart, $weekStart])->sum('amount');

        // Booking by platform from the bookings' own source field.
        $palette = ['#d2f3e4', '#b6d8cb', '#cbd877', '#e8fb82', '#f4fac3', '#eefbf4', '#dddddd'];
        $totalB = max(1, Booking::count());
        $platforms = Booking::selectRaw('source, count(*) as n')->groupBy('source')->orderByDesc('n')->get()
            ->values()->map(function ($row, $i) use ($totalB, $palette) {
                return ['name' => $row->source ?: 'Direct Booking', 'percent' => round($row->n / $totalB * 100, 1), 'color' => $palette[$i % count($palette)]];
            })->all();

        // Rating bars from the reviews' category scores.
        $ratingCats = collect(['facilities' => 'Facilities', 'cleanliness' => 'Cleanliness', 'services' => 'Services', 'comfort' => 'Comfort', 'location' => 'Location'])
            ->map(fn ($label, $col) => ['name' => $label, 'score' => round((float) Review::whereNotNull($col)->avg($col), 1)])->values();

        $today = now()->toDateString();
        $totalUnits = RoomUnit::count();
        return view('Dashboard', [
            'bookings'     => Booking::orderBy('id')->take(5)->get(),
            // Figma dashboard blocks
            'arrivals'     => Booking::whereDate('check_in', $today)->whereIn('status', ['pending', 'confirmed', 'checked_in'])->orderBy('id')->get(),
            'departures'   => Booking::whereDate('check_out', $today)->whereIn('status', ['checked_in', 'checked_out'])->orderBy('id')->get(),
            'hkCounts'     => [
                'ready' => HousekeepingTask::where('status', 'ready')->count(), 'needs' => HousekeepingTask::where('status', 'needs')->count(),
                'progress' => HousekeepingTask::where('status', 'progress')->count(), 'inspect' => HousekeepingTask::where('status', 'inspect')->count(),
            ],
            'occupancyPct' => $totalUnits ? round(RoomUnit::where('status', 'occupied')->count() / $totalUnits * 100) : 0,
            'totalUnits'   => $totalUnits,
            'todayRevenue' => (int) Booking::where('invoice_status', 'paid')->whereDate('updated_at', $today)->sum('amount'),
            'tasks'        => Task::all(),
            'activities'   => Activity::latest('id')->take(6)->get(),
            'deltas'       => [
                'bookings' => $pct($bookingsNow, $bookingsPrev), 'checkIn' => $pct($checkInNow, $checkInPrev),
                'checkOut' => $pct($checkOutNow, $checkOutPrev), 'revenue' => $pct($revNow, $revPrev),
            ],
            // stat cards
            'newBookings'  => Booking::count(),
            'checkIn'      => Booking::where('status', 'checked_in')->count(),
            'checkOut'     => Booking::where('status', 'checked_out')->count(),
            'totalRevenue' => (int) Booking::where('invoice_status', 'paid')->sum('amount'),
            // room availability
            'occupied'     => $occupied,
            'available'    => $available,
            'reserved'     => $reservedRooms,
            'notReady'     => $notReadyRooms,
            // rating
            'ratingAvg'    => round((float) Review::avg('rating'), 1),
            'reviewCount'  => Review::count(),
            // Dashboard charts are calculated from actual booking records.
            'revenues'         => $this->revenueSeries(),
            'reservationStats' => $this->reservationSeries(),
            'platforms'        => $platforms,
            'ratingCats'       => $ratingCats,
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
            'guests' => Guest::all()->keyBy('id'),
            'units' => RoomUnit::with('room:id,name')->orderBy('number')->get()->map(function ($u) {
                return ['id' => $u->id, 'number' => $u->number, 'status' => $u->status, 'type' => optional($u->room)->name];
            })->values(),
        ]);
    }

    public function bookingStore(Request $r)
    {
        $data = $r->validate([
            'guest_name'=>'required','cnic'=>'nullable|string|max:20','phone'=>'nullable|string|max:30','email'=>'nullable|email|max:255',
            'dob'=>'nullable|date','gender'=>'nullable|string|max:30','nationality'=>'nullable|string|max:100','passport_no'=>'nullable|string|max:100',
            'room_type'=>'nullable','room_number'=>'nullable',
            'request'=>'nullable','duration'=>'nullable','check_in'=>'required|date','check_out'=>'required|date|after:check_in','guests'=>'nullable|integer|min:1|max:20','source'=>'nullable|string|max:60',
            'price_per_night'=>'required|integer|min:1','amount'=>'nullable|integer','extra_charges'=>'nullable|integer|min:0','status'=>'nullable',
            'partial_payment'=>'nullable|boolean','advance_amount'=>'nullable|integer|min:0',
            'advance_receipt'=>'nullable|image|max:5120',
            'amenities'=>'nullable|array','amenity_notes'=>'nullable|string|max:500',
        ]);
        $data['partial_payment'] = $r->boolean('partial_payment');
        $data['advance_amount'] = (int) ($data['advance_amount'] ?? 0);
        $data['price_per_night'] = (int) $data['price_per_night'];
        // Total = price per night x nights + extra charges.
        $data['extra_charges'] = (int) ($data['extra_charges'] ?? 0);
        $nights = max(1, \Carbon\Carbon::parse($data['check_in'])->diffInDays(\Carbon\Carbon::parse($data['check_out'])));
        $data['duration'] = (string) $nights;
        $data['amount'] = $data['price_per_night'] * $nights + $data['extra_charges'];
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
        // Room numbers come from the room-number list; a room can only be booked while it is available.
        $unit = RoomUnit::findByNumber($data['room_number'] ?? '');
        $typeHasUnits = !empty($data['room_type']) && RoomUnit::whereHas('room', function ($q) use ($data) { $q->where('name', $data['room_type']); })->exists();
        if ($typeHasUnits && !$unit) {
            return back()->withErrors(['room_number' => 'Please choose a room number from the list.'])->withInput();
        }
        if ($unit && $unit->status !== 'available') {
            return back()->withErrors(['room_number' => 'Room '.$unit->number.' is '.str_replace('_', ' ', $unit->status).' and cannot be booked.'])->withInput();
        }
        $booking = Booking::create($data);
        $this->syncRoomForBooking($booking);
        $this->logActivity('New reservation', $booking->guest_name.' booked '.($booking->room_label ?: 'a room').' ('.$booking->code.').', 'lime');
        return back()->with('ok', 'Booking added');
    }

    public function bookingUpdate(Request $r, $id)
    {
        $booking = Booking::findOrFail($id);
        $data = $r->validate([
            'guest_name'=>'required','cnic'=>'nullable|string|max:20','phone'=>'nullable|string|max:30','email'=>'nullable|email|max:255',
            'room_type'=>'nullable','room_number'=>'nullable','request'=>'nullable','duration'=>'nullable','check_in'=>'required|date','check_out'=>'required|date|after:check_in',
            'guests'=>'nullable|integer|min:1|max:20','source'=>'nullable|string|max:60','price_per_night'=>'required|integer|min:1','extra_charges'=>'nullable|integer|min:0',
        ]);
        $newNumber = trim((string) ($data['room_number'] ?? ''));
        $oldNumber = trim((string) $booking->room_number);
        if ($newNumber !== $oldNumber) {
            $unit = RoomUnit::findByNumber($newNumber);
            if ($unit && $unit->status !== 'available') {
                return back()->with('ok', 'Room '.$unit->number.' is '.str_replace('_', ' ', $unit->status).' and cannot be assigned.');
            }
            $this->releaseRoomForBooking($booking);
        }
        if ($booking->guest_id) {
            Guest::where('id', $booking->guest_id)->update(array_filter([
                'name' => $data['guest_name'], 'phone' => $data['phone'] ?? null, 'email' => $data['email'] ?? null,
            ], fn ($v) => $v !== null));
        }
        unset($data['phone'], $data['email']);
        $data['extra_charges'] = (int) ($data['extra_charges'] ?? 0);
        $nights = max(1, \Carbon\Carbon::parse($data['check_in'])->diffInDays(\Carbon\Carbon::parse($data['check_out'])));
        $data['duration'] = (string) $nights;
        $data['amount'] = $data['price_per_night'] * $nights + $data['extra_charges'];
        $data['room_label'] = trim(($data['room_type'] ?? '').' '.$newNumber);
        $booking->update($data);
        $this->syncRoomForBooking($booking->fresh());
        return back()->with('ok', 'Reservation updated');
    }

    public function bookingConfirm($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'confirmed', 'invoice_status' => $booking->partial_payment ? 'partial' : 'paid']);
        $this->syncRoomForBooking($booking);
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
            $booking = Booking::findOrFail($id);
            $booking->update($data);
            $this->syncRoomForBooking($booking);
            $labels = ['confirmed' => 'Booking confirmed', 'checked_in' => 'Guest checked in', 'checked_out' => 'Guest checked out', 'pending' => 'Booking set to pending'];
            $this->logActivity($labels[$status], $booking->guest_name.' · '.($booking->room_label ?: '').' ('.$booking->code.')');
        }
        return back();
    }

    public function bookingDestroy($id)
    {
        $booking = Booking::findOrFail($id);
        $this->releaseRoomForBooking($booking);
        $this->logActivity('Booking cancelled', $booking->guest_name.' · '.($booking->room_label ?: '').' ('.$booking->code.')', 'mint');
        $booking->delete();
        return back();
    }

    /** Record a dashboard activity entry. */
    private function logActivity(string $title, string $description, string $icon = 'mint')
    {
        Activity::create(['time' => now()->format('M j, g:i A'), 'title' => $title, 'description' => $description, 'icon' => $icon]);
    }

    /** Keep the booked room number, housekeeping and inventory in step with the booking status. */
    private function syncRoomForBooking(Booking $booking)
    {
        $unit = RoomUnit::findByNumber($booking->room_number);
        if ($booking->status === 'checked_in') {
            $this->useCheckinSupplies($booking);
        }
        if (!$unit) {
            return;
        }
        if (in_array($booking->status, ['pending', 'confirmed'])) {
            $unit->update(['status' => 'reserved']);
        } elseif ($booking->status === 'checked_in') {
            $unit->update(['status' => 'occupied']);
        } elseif ($booking->status === 'checked_out') {
            // The room needs cleaning before it can be booked again; housekeeping marks it Ready.
            $unit->update(['status' => 'not_ready']);
            HousekeepingTask::updateOrCreate(
                ['room_number' => 'Room '.$unit->number],
                ['room_type' => $booking->room_type, 'status' => 'needs', 'priority' => 'high', 'reservation_status' => 'Checked-Out',
                 'notes' => 'Guest checked out ('.$booking->code.'). Room needs cleaning.', 'is_checked' => false]
            );
        }
        Room::syncCounts();
    }

    /** A cancelled booking frees its room number again. */
    private function releaseRoomForBooking(Booking $booking)
    {
        $unit = RoomUnit::findByNumber($booking->room_number);
        if ($unit && in_array($unit->status, ['reserved', 'occupied'])) {
            $unit->update(['status' => 'available']);
            Room::syncCounts();
        }
    }

    /** Hand out each item's "used per check-in" quantity, once per booking. */
    private function useCheckinSupplies(Booking $booking)
    {
        $ref = 'Check-in '.$booking->code;
        if (InventoryMovement::where('reference', $ref)->exists()) {
            return;
        }
        foreach (InventoryItem::where('per_checkin', '>', 0)->get() as $item) {
            $item->adjust(-(int) $item->per_checkin, 'Used at check-in', $ref);
        }
    }

    /* ===================== ROOMS ===================== */
    public function rooms()
    {
        $rooms = Room::with('units')->orderBy('id')->get();
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
        $room = Room::findOrFail($id);
        // A room type with booked room numbers cannot be removed; free numbers go with the type.
        $busy = $room->units()->whereIn('status', ['reserved', 'occupied'])->count();
        if ($busy > 0) {
            return back()->with('ok', $room->name.' has '.$busy.' booked room'.($busy === 1 ? '' : 's').' and cannot be deleted.');
        }
        $room->units()->delete();
        $room->delete();
        return back()->with('ok', $room->name.' removed');
    }

    /* ===================== ROOM NUMBERS ===================== */
    public function unitStore(Request $r, $id)
    {
        $room = Room::findOrFail($id);
        $data = $r->validate(['numbers' => 'required|string|max:500']);
        $added = 0;
        $taken = [];
        foreach (preg_split('/[\s,]+/', $data['numbers'], -1, PREG_SPLIT_NO_EMPTY) as $n) {
            $n = trim(preg_replace('/^room\s*/i', '', $n));
            if ($n === '') {
                continue;
            }
            if (RoomUnit::where('number', $n)->exists()) {
                $taken[] = $n;
                continue;
            }
            RoomUnit::create(['room_id' => $room->id, 'number' => $n]);
            $added++;
        }
        Room::syncCounts();
        $msg = $added.' room number'.($added === 1 ? '' : 's').' added';
        if ($taken) {
            $msg .= ' (already exists: '.implode(', ', $taken).')';
        }
        return back()->with('ok', $msg);
    }

    public function unitStatus(Request $r, $id)
    {
        $unit = RoomUnit::findOrFail($id);
        $data = $r->validate(['status' => 'required|in:available,not_ready']);
        if (in_array($unit->status, ['reserved', 'occupied'])) {
            return back()->with('ok', 'Room '.$unit->number.' has an active booking. Change the booking instead.');
        }
        $unit->update(['status' => $data['status']]);
        $task = HousekeepingTask::where('room_number', 'Room '.$unit->number)->first();
        if ($task) {
            $task->update(['status' => $data['status'] === 'available' ? 'ready' : 'needs']);
        }
        Room::syncCounts();
        return back()->with('ok', 'Room '.$unit->number.' is now '.str_replace('_', ' ', $data['status']));
    }

    public function unitDestroy($id)
    {
        $unit = RoomUnit::findOrFail($id);
        if (in_array($unit->status, ['reserved', 'occupied'])) {
            return back()->with('ok', 'Room '.$unit->number.' has an active booking and cannot be removed.');
        }
        $unit->delete();
        Room::syncCounts();
        return back()->with('ok', 'Room '.$unit->number.' removed');
    }

    /* ===================== INVOICE ===================== */
    public function invoice()
    {
        // An invoice becomes available only after the booking is confirmed.
        $bookings = Booking::whereIn('status', ['confirmed', 'checked_in', 'checked_out'])->orderBy('id')->get();

        $totals = ['invoiced' => 0, 'collected' => 0, 'outstanding' => 0, 'unpaid' => 0];
        foreach ($bookings as $b) {
            $nights = max(1, (int) preg_replace('/\D+/', '', (string) $b->duration));
            $total = (float) ($b->amount ?: ((int) $b->price_per_night * $nights));
            $advance = min($total, (float) $b->advance_amount);
            $final = $b->invoice_status === 'paid' ? max(0, $total - $advance) : 0;
            $paid = $advance + $final;

            $totals['invoiced'] += $total;
            $totals['collected'] += $paid;
            $totals['outstanding'] += max(0, $total - $paid);
            $totals['unpaid'] += $b->invoice_status === 'paid' ? 0 : 1;
        }

        return view('invoice', compact('bookings', 'totals'));
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

    /** Render the invoice from the Blade template (resources/views/pdf/invoice.blade.php) with mpdf. */
    private function makeInvoicePdf(Booking $booking, int $nights, float $total, float $advance, float $finalPayment, float $remaining): string
    {
        $html = view('pdf.invoice', compact('booking', 'nights', 'total', 'advance', 'finalPayment', 'remaining'))->render();

        $fontDirs = (new \Mpdf\Config\ConfigVariables())->getDefaults()['fontDir'];
        $fontData = (new \Mpdf\Config\FontVariables())->getDefaults()['fontdata'];
        $tempDir = storage_path('app/mpdf');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0775, true);
        }

        $pdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_top' => 0, 'margin_bottom' => 0, 'margin_left' => 0, 'margin_right' => 0,
            'tempDir' => $tempDir,
            'fontDir' => array_merge($fontDirs, [resource_path('fonts')]),
            'fontdata' => $fontData + [
                'lato' => ['R' => 'Lato-Regular.ttf', 'B' => 'Lato-Bold.ttf', 'I' => 'Lato-Italic.ttf'],
                'latoblack' => ['R' => 'Lato-Black.ttf'],
                'greatvibes' => ['R' => 'GreatVibes-Regular.ttf'],
            ],
            'default_font' => 'lato',
        ]);
        $pdf->SetTitle('Invoice '.$booking->code);
        $pdf->WriteHTML($html);

        return $pdf->Output('', \Mpdf\Output\Destination::STRING_RETURN);
    }

    /* ===================== EXPENSES ===================== */
    /** Hotel expense categories, grouped. Custom categories typed by staff are added to the list automatically. */
    public const EXPENSE_CATEGORIES = [
        'Utilities' => ['Electricity Bill', 'Gas Bill', 'Water Bill', 'Internet & Wi-Fi', 'Phone Bill', 'Generator Fuel / Diesel', 'Cable / TV Subscription'],
        'Salaries & Wages' => ['Staff Salaries', 'Overtime', 'Bonuses', 'Staff Meals', 'Staff Accommodation', 'Uniforms'],
        'Housekeeping & Supplies' => ['Cleaning Supplies', 'Toiletries & Amenities', 'Linen & Towels', 'Laundry', 'Room Supplies', 'Pest Control'],
        'Kitchen & Restaurant' => ['Groceries & Raw Food', 'Beverages', 'Kitchen Gas / LPG', 'Kitchen Equipment', 'Crockery & Cutlery', 'Packaging'],
        'Maintenance & Repairs' => ['Plumbing', 'Electrical Work', 'Painting & Renovation', 'Furniture Repair', 'AC / Heater Service', 'Appliance Repair', 'Garden & Lawn'],
        'Marketing & Advertising' => ['Social Media Ads', 'Website & Hosting', 'Booking Platform Commission', 'Printing & Signage', 'Promotions & Discounts'],
        'Administrative' => ['Office Supplies', 'Software & Subscriptions', 'Bank Charges', 'Licenses & Permits', 'Insurance', 'Legal & Accounting', 'Taxes & Fees'],
        'Transport' => ['Fuel', 'Vehicle Maintenance', 'Guest Pickup / Drop', 'Delivery Charges'],
        'Guest Services' => ['Welcome Refreshments', 'Bonfire & Events', 'Entertainment', 'Guest Gifts', 'Complaint Compensation'],
        'Security' => ['Security Staff', 'CCTV & Alarm', 'Fire Safety'],
        'Other' => ['Miscellaneous', 'Donations', 'Petty Cash'],
    ];

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
        $year = (int) (request('year') ?: now()->year);
        $years = collect([now()->year])->merge(Expense::selectRaw('YEAR(date) as y')->pluck('y'))->merge(Booking::selectRaw('YEAR(check_in) as y')->pluck('y'))->filter()->unique()->sortDesc()->values();
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
            'years' => $years,
            'categoryGroups' => (function () use ($expenses) {
                $groups = self::EXPENSE_CATEGORIES;
                $known = collect($groups)->flatten();
                $custom = $expenses->pluck('category')->filter()->unique()->reject(fn ($c) => $known->contains($c))->values()->all();
                if ($custom) {
                    $groups['Custom'] = $custom;
                }
                return $groups;
            })(),
        ]);
    }

    public function expenseStore(Request $r)
    {
        $data = $r->validate([
            'name'=>'required','category'=>'nullable|string|max:120','custom_category'=>'nullable|string|max:255','quantity'=>'nullable|integer',
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

    public function expenseUpdate(Request $r, $id)
    {
        $e = Expense::findOrFail($id);
        $data = $r->validate([
            'name'=>'required','category'=>'nullable|string|max:120','custom_category'=>'nullable|string|max:255','quantity'=>'nullable|integer',
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
        $e->update($data);
        return back()->with('ok', 'Expense updated');
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

    public function conciergeUpdate(Request $r, $id)
    {
        $c = Concierge::findOrFail($id);
        $c->update($r->validate([
            'name'=>'required','position'=>'nullable','schedule_days'=>'nullable',
            'schedule_time'=>'nullable','contact'=>'nullable','email'=>'nullable',
        ]));
        return back()->with('ok', 'Staff member updated');
    }

    public function conciergeDestroy($id)
    {
        Concierge::findOrFail($id)->delete();
        return back();
    }

    public function scheduleUpdate(Request $r, $id)
    {
        Schedule::findOrFail($id)->update($r->validate([
            'title'=>'required','category'=>'nullable','date'=>'required',
            'start_time'=>'nullable','end_time'=>'nullable',
        ]));
        return back()->with('ok', 'Schedule updated');
    }

    public function scheduleDestroy($id)
    {
        Schedule::findOrFail($id)->delete();
        return back()->with('ok', 'Schedule removed');
    }

    /* ===================== HOUSEKEEPING ===================== */
    public function housekeeping()
    {
        return view('housekeeping', [
            'rows' => HousekeepingTask::orderBy('id')->get(),
            'roomTypes' => Room::orderBy('name')->pluck('name'),
            'units' => RoomUnit::with('room:id,name')->orderBy('number')->get()->map(function ($u) {
                return ['number' => $u->number, 'type' => optional($u->room)->name];
            })->values(),
        ]);
    }

    public function hkStore(Request $r)
    {
        $task = HousekeepingTask::create($r->validate([
            'room_number'=>'required','room_type'=>'nullable','status'=>'nullable',
            'priority'=>'nullable','floor'=>'nullable','reservation_status'=>'nullable','notes'=>'nullable',
        ]));
        $this->syncUnitFromHousekeeping($task);
        return back()->with('ok', 'Room added');
    }

    public function hkUpdate(Request $r, $id)
    {
        $t = HousekeepingTask::findOrFail($id);
        $t->update($r->only(['status', 'priority', 'is_checked']));
        if ($r->has('status')) {
            $this->syncUnitFromHousekeeping($t);
        }
        return back();
    }

    /** Housekeeping "Ready" frees the room number; any other cleaning state marks it not ready (bookings always win). */
    private function syncUnitFromHousekeeping(HousekeepingTask $task)
    {
        $unit = RoomUnit::findByNumber($task->room_number);
        if (!$unit || in_array($unit->status, ['reserved', 'occupied'])) {
            return;
        }
        $unit->update(['status' => $task->status === 'ready' ? 'available' : 'not_ready']);
        Room::syncCounts();
    }

    public function hkEdit(Request $r, $id)
    {
        $t = HousekeepingTask::findOrFail($id);
        $t->update($r->validate(['floor'=>'nullable','reservation_status'=>'nullable','notes'=>'nullable','priority'=>'nullable','status'=>'nullable']));
        $this->syncUnitFromHousekeeping($t);
        return back()->with('ok', 'Housekeeping updated');
    }

    public function hkDestroy($id)
    {
        HousekeepingTask::findOrFail($id)->delete();
        return back();
    }

    /* ===================== INVENTORY ===================== */
    public function inventory()
    {
        $items = InventoryItem::orderBy('id')->get();
        $recent = InventoryMovement::latest('id')->take(400)->get()->groupBy('item_id');
        $items->each(function ($i) use ($recent) {
            $i->setAttribute('recent', collect($recent->get($i->id, []))->take(6)->map(function ($m) {
                return ['change' => $m->change, 'reason' => $m->reason, 'reference' => $m->reference, 'at' => $m->created_at->format('M j, g:i A')];
            })->values());
        });
        return view('inventory', ['items' => $items]);
    }

    public function invStore(Request $r)
    {
        $data = $r->validate([
            'name'=>'required','category'=>'nullable','availability'=>'nullable','image'=>'nullable|image|max:5120',
            'quantity_stock'=>'nullable|integer','quantity_reorder'=>'nullable|integer','per_checkin'=>'nullable|integer|min:0',
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

    public function invUpdate(Request $r, $id)
    {
        $i = InventoryItem::findOrFail($id);
        $data = $r->validate([
            'name'=>'required','category'=>'nullable','image'=>'nullable|image|max:5120',
            'quantity_reorder'=>'nullable|integer|min:0','per_checkin'=>'nullable|integer|min:0',
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
        $i->update($data);
        // Stock itself changes through Add Stock / Use Stock so the movement log stays complete.
        $stock = $i->quantity_stock;
        $i->update(['availability' => $stock <= 0 ? 'out' : ($stock < $i->quantity_reorder ? 'low' : 'available')]);
        return back()->with('ok', 'Item updated');
    }

    public function invAddStock(Request $r, $id)
    {
        $i = InventoryItem::findOrFail($id);
        $data = $r->validate(['quantity' => 'required|integer|min:1']);
        $i->adjust((int) $data['quantity'], 'Stock added');
        return back()->with('ok', 'Stock added successfully');
    }

    public function invUseStock(Request $r, $id)
    {
        $i = InventoryItem::findOrFail($id);
        $data = $r->validate(['quantity' => 'required|integer|min:1', 'reason' => 'nullable|string|max:120']);
        if ($data['quantity'] > $i->quantity_stock) {
            return back()->with('ok', 'Only '.$i->quantity_stock.' '.$i->name.' in stock');
        }
        $i->adjust(-(int) $data['quantity'], $data['reason'] ?: 'Used by staff');
        return back()->with('ok', $data['quantity'].' '.$i->name.' used, '.$i->quantity_stock.' left');
    }

    public function invSettings(Request $r, $id)
    {
        $i = InventoryItem::findOrFail($id);
        $i->update($r->validate(['per_checkin' => 'required|integer|min:0']));
        return back()->with('ok', 'Per check-in usage saved');
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
        $reviews = Review::orderBy('id')->get();
        $cats = collect(['facilities' => 'Facilities', 'cleanliness' => 'Cleanliness', 'services' => 'Services', 'comfort' => 'Comfort', 'location' => 'Location'])
            ->map(fn ($label, $col) => ['name' => $label, 'score' => round((float) Review::whereNotNull($col)->avg($col), 1)])->values();
        // Positive (4-5 stars) vs negative (1-3 stars) reviews for each of the last 7 days.
        $trend = collect(range(6, 0))->map(function ($d) {
            $day = now()->subDays($d);
            $q = Review::whereDate('created_at', $day->toDateString());
            return ['label' => $day->format('D'), 'positive' => (clone $q)->where('rating', '>=', 4)->count(), 'negative' => (clone $q)->where('rating', '<=', 3)->count()];
        })->all();
        return view('reviews', ['reviews' => $reviews, 'cats' => $cats, 'trend' => $trend,
            'avg' => round((float) $reviews->avg('rating'), 1), 'count' => $reviews->count()]);
    }

    public function reviewStore(Request $r)
    {
        $data = $r->validate([
            'customer_name'=>'required|string|max:120','rating'=>'required|integer|min:1|max:5','text'=>'nullable|string|max:2000',
            'facilities'=>'nullable|integer|min:1|max:5','cleanliness'=>'nullable|integer|min:1|max:5','services'=>'nullable|integer|min:1|max:5',
            'comfort'=>'nullable|integer|min:1|max:5','location'=>'nullable|integer|min:1|max:5',
        ]);
        $data['date'] = now()->format('F j, Y');
        Review::create($data);
        return back()->with('ok', 'Review added');
    }

    public function reviewDestroy($id)
    {
        Review::findOrFail($id)->delete();
        return back()->with('ok', 'Review removed');
    }

    /* ===================== GUEST PROFILE ===================== */
    public function guestProfile(Request $request)
    {
        $booking = $request->filled('id')
            ? (Booking::find($request->id) ?: Booking::first())
            : Booking::first();
        if (!$booking) {
            return redirect('/reservation')->with('ok', 'No reservations yet. Add one to see guest details.');
        }
        $guest = $booking && $booking->guest_id ? Guest::find($booking->guest_id) : null;
        if (!$guest && $booking) {
            $guest = Guest::where('name', $booking->guest_name)->first();
        }
        if (!$guest) {
            $guest = new Guest(['name' => $booking ? $booking->guest_name : 'Guest']);
        }
        // This guest's own stay history, newest first (fall back to the shown booking alone).
        $history = Booking::query()
            ->when($guest->exists, fn ($q) => $q->where(function ($w) use ($guest) {
                $w->where('guest_id', $guest->id)->orWhere('guest_name', $guest->name);
            }), fn ($q) => $q->where('id', $booking->id))
            ->orderByDesc('id')->get();
        if ($history->isEmpty()) {
            $history = collect([$booking]);
        }

        $stats = [
            'bookings' => $history->count(),
            'nights' => $history->sum(fn ($b) => max(1, (int) preg_replace('/\D+/', '', (string) $b->duration))),
            'spend' => $history->sum(fn ($b) => (int) $b->amount),
            'since' => optional($history->min('created_at')) ? \Carbon\Carbon::parse($history->min('created_at'))->format('M Y') : null,
        ];

        $room = $booking ? Room::where('name', $booking->room_type)->first() : null;
        $roomImages = Room::pluck('image', 'name');
        return view('guest-profile', compact('guest', 'booking', 'history', 'room', 'roomImages', 'stats'));
    }
}
