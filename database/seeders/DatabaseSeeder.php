<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        foreach (['room_units','inventory_movements','rooms','guests','bookings','housekeeping_tasks','inventory_items','schedules','expenses','concierges','reviews','tasks','activities','revenues','reservation_stats','platforms','rating_categories'] as $t) {
            if (\Schema::hasTable($t)) \DB::table($t)->truncate();
        }

        $Y = (int) now()->year; $M = (int) now()->month;
        $dim = (int) \Carbon\Carbon::create($Y, $M, 1)->daysInMonth;
        $dm = function ($d) use ($Y, $M, $dim) { return sprintf('%d-%02d-%02d', $Y, $M, min($d, $dim)); };
        $dmf = function ($d) use ($dm) { return \Carbon\Carbon::parse($dm($d))->format('F j, Y'); };


        // Real rooms, room numbers and housekeeping rows for Indus Resort (website + requirements form).
        $this->call(IndusResortSeeder::class);

        $inv = [
            ['Bath Towels','🧻','Linen','available',120,50,0,'assets/inventory/bath-towels.jpg'],
            ['Shampoo Bottles','🧴','Toiletries','low',20,100,0,'assets/inventory/shampoo-bottles.jpg'],
            ['Coffee Pods','☕','Refreshments','out',0,200,1,'assets/inventory/coffee-pods.jpg'],
            ['Room Key Cards','🎫','Electronics','available',500,100,0,'assets/inventory/room-key-cards.jpg'],
            ['Cleaning Supplies','🧹','Housekeeping','available',300,50,0,'assets/inventory/cleaning-supplies.jpg'],
            ['Mini Bar Snacks','🍫','Refreshments','low',15,50,0,'assets/inventory/mini-bar-snacks.jpg'],
            ['Bed Linens','🛏️','Linen','available',80,30,0,'assets/inventory/bed-linens.jpg'],
            ['Bathrobes','🥼','Linen','low',10,50,0,'assets/inventory/bathrobes.jpg'],
            ['Slippers','🥿','Guest Comfort','available',150,50,0,'assets/inventory/slippers.jpg'],
            ['Water Bottles','💧','Refreshments','available',200,100,0,'assets/inventory/water-bottles.jpg'],
            ['Kettle','🫖','Kitchen','out',0,130,0,'assets/inventory/kettle.jpg'],
        ];
        foreach ($inv as $i) {
            InventoryItem::create(['name'=>$i[0],'emoji'=>$i[1],'category'=>$i[2],'availability'=>$i[3],'quantity_stock'=>$i[4],'quantity_reorder'=>$i[5],'is_checked'=>$i[6],'image_path'=>$i[7],
                'per_checkin'=>['Bath Towels'=>2,'Shampoo Bottles'=>1,'Slippers'=>1,'Water Bottles'=>2,'Room Key Cards'=>1,'Bed Linens'=>1][$i[0]] ?? 0]);
        }

        // Staff, expenses, calendar, reviews, tasks and activities start empty: they are entered from the dashboard.


        \DB::table('revenues')->insert([
            ['label'=>'Jun 2027','amount'=>180000,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'Jul 2027','amount'=>210000,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'Aug 2027','amount'=>195000,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'Sep 2027','amount'=>230000,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'Oct 2027','amount'=>205000,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'Nov 2027','amount'=>240000,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'Dec 2027','amount'=>200000,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'Jan 2028','amount'=>170000,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'Feb 2028','amount'=>315060,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'Mar 2028','amount'=>205000,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'Apr 2028','amount'=>390000,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'May 2028','amount'=>250000,'created_at'=>now(),'updated_at'=>now()],
        ]);
        \DB::table('reservation_stats')->insert([
            ['label'=>'12 Jun','booked'=>60,'canceled'=>12,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'13 Jun','booked'=>67,'canceled'=>12,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'14 Jun','booked'=>64,'canceled'=>10,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'15 Jun','booked'=>71,'canceled'=>12,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'16 Jun','booked'=>77,'canceled'=>14,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'17 Jun','booked'=>66,'canceled'=>12,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'18 Jun','booked'=>50,'canceled'=>13,'created_at'=>now(),'updated_at'=>now()],
        ]);
        \DB::table('platforms')->insert([
            ['name'=>'Direct Booking','percent'=>61,'color'=>'#d2f3e4','created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Booking.com','percent'=>12,'color'=>'#b6d8cb','created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Agoda','percent'=>11,'color'=>'#cbd877','created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Airbnb','percent'=>9,'color'=>'#e8fb82','created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Hotels.com','percent'=>5,'color'=>'#f4fac3','created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Others','percent'=>2,'color'=>'#eefbf4','created_at'=>now(),'updated_at'=>now()],
        ]);
        \DB::table('rating_categories')->insert([
            ['name'=>'Facilities','score'=>4.4,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Cleanliness','score'=>4.7,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Services','score'=>4.6,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Comfort','score'=>4.8,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Location','score'=>4.5,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
