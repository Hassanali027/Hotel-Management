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
        Booking::create($data);
        return back()->with('ok', 'Booking added');
    }

    public function bookingConfirm($id)
    {
        Booking::findOrFail($id)->update(['status' => 'confirmed']);
        return back();
    }

    public function bookingStatus($id, $status)
    {
        $allowed = ['pending', 'confirmed', 'checked_in', 'checked_out'];
        if (in_array($status, $allowed)) {
            Booking::findOrFail($id)->update(['status' => $status]);
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
        return view('invoice', ['bookings' => Booking::orderBy('id')->get()]);
    }

    /* ===================== EXPENSES ===================== */
    public function expenses()
    {
        return view('expenses', ['expenses' => Expense::orderBy('id')->get()]);
    }

    public function expenseStore(Request $r)
    {
        Expense::create($r->validate([
            'name'=>'required','category'=>'nullable','quantity'=>'nullable|integer',
            'amount'=>'nullable|integer','date'=>'nullable',
        ]) + ['status' => 'completed']);
        return back()->with('ok', 'Expense added');
    }

    public function expenseDestroy($id)
    {
        Expense::findOrFail($id)->delete();
        return back();
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
        InventoryItem::create($r->validate([
            'name'=>'required','emoji'=>'nullable','category'=>'nullable','availability'=>'nullable',
            'quantity_stock'=>'nullable|integer','quantity_reorder'=>'nullable|integer',
        ]));
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
