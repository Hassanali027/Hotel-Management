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
        foreach (['rooms','guests','bookings','housekeeping_tasks','inventory_items','schedules','expenses','concierges','reviews','tasks','activities','revenues','reservation_stats','platforms','rating_categories'] as $t) {
            if (\Schema::hasTable($t)) \DB::table($t)->truncate();
        }

        $Y = (int) now()->year; $M = (int) now()->month;
        $dim = (int) \Carbon\Carbon::create($Y, $M, 1)->daysInMonth;
        $dm = function ($d) use ($Y, $M, $dim) { return sprintf('%d-%02d-%02d', $Y, $M, min($d, $dim)); };
        $dmf = function ($d) use ($dm) { return \Carbon\Carbon::parse($dm($d))->format('F j, Y'); };

        $hero = 'images/room-info-hero.jpg';
        $features = ['Private balcony (where applicable)','Work desk with ergonomic chair','Spacious layout with a modern design','Large windows offering city or garden views'];
        $facilities = ['High-speed Wi-Fi','In-room safe','Mini-fridge','Flat-screen TV','Air conditioning','Coffee/tea maker'];
        $amenities = ['Complimentary bottled water','Luxury toiletries','Coffee and tea making facilities','Hairdryer','Premium bedding and linens','Bathrobe and slippers','Ensuite bathroom with shower and bathtub','24-hour room service'];

        Room::insert([
            ['name'=>'Standard','status'=>'occupied','size'=>'25 m²','bed'=>'Queen Bed','guests'=>'2 guests','description'=>'Comfortable, affordable stay for solo travelers or couples. Queen bed, en-suite bathroom, work desk, essential amenities.','availability_used'=>8,'availability_total'=>30,'price'=>100,'image'=>$hero,'is_featured'=>0,'features'=>json_encode($features),'facilities'=>json_encode($facilities),'amenities'=>json_encode($amenities),'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Deluxe','status'=>'available','size'=>'35 m²','bed'=>'King Bed','guests'=>'2 guests','description'=>'More space and luxury. King bed, separate seating, larger desk, 55-inch TV. En-suite bathroom with bathtub and shower.','availability_used'=>18,'availability_total'=>25,'price'=>150,'image'=>$hero,'is_featured'=>1,'features'=>json_encode($features),'facilities'=>json_encode($facilities),'amenities'=>json_encode($amenities),'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Suite','status'=>'available','size'=>'50 m²','bed'=>'King Bed','guests'=>'3 guests','description'=>'Spacious and private with separate living and sleeping areas. King bed, furnished living room, kitchenette - ideal for extended stays.','availability_used'=>2,'availability_total'=>10,'price'=>250,'image'=>$hero,'is_featured'=>0,'features'=>json_encode($features),'facilities'=>json_encode($facilities),'amenities'=>json_encode($amenities),'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Family','status'=>'occupied','size'=>'45 m²','bed'=>'2 Queen Beds','guests'=>'4 guests','description'=>'Designed for comfort and practicality. Two queen beds, bunk beds accommodate up to 6 guests. En-suite bathroom, seating area, 50-inch TV.','availability_used'=>3,'availability_total'=>15,'price'=>200,'image'=>$hero,'is_featured'=>0,'features'=>json_encode($features),'facilities'=>json_encode($facilities),'amenities'=>json_encode($amenities),'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Single','status'=>'available','size'=>'20 m²','bed'=>'Single Bed','guests'=>'1 guests','description'=>'Features a single bed, en-suite bathroom, work desk, and essential amenities for a practical and functional stay.','availability_used'=>3,'availability_total'=>20,'price'=>70,'image'=>$hero,'is_featured'=>0,'features'=>json_encode($features),'facilities'=>json_encode($facilities),'amenities'=>json_encode($amenities),'created_at'=>now(),'updated_at'=>now()],
        ]);

        Guest::insert([
            ['name'=>'Angus Copper','code'=>'G011-987654321','phone'=>'+1 (555) 789-1234','email'=>'angus.copper@example.com','dob'=>'June 15, 1985','gender'=>'Male','nationality'=>'American','passport_no'=>'A12345678','membership_status'=>'Platinum Member','points_balance'=>'15,000 points','tier_level'=>'Elite','avatar'=>null,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // code, guest, room_type, room_number, room_label, request, duration, in, out, ppn, amount, status, invoice_status
        $bk = [
            ['LG-B00108','Angus Copper','Deluxe','101','Deluxe 101','Late Check-Out','3 nights',$dm(19),$dm(22),150,450,'confirmed','paid'],
            ['LG-B00109','Catherine Lopp','Standard','202','Standard 202','None','2 nights',$dm(19),$dm(21),100,200,'confirmed','unpaid'],
            ['LG-B00110','Edgar Irving','Suite','303','Suite 303','Extra Pillows','5 nights',$dm(19),$dm(24),250,1250,'pending','paid'],
            ['LG-B00111','Gertrude Bale','Standard','204','Standard 204','Early Check-In','1 nights',$dm(19),$dm(20),100,100,'confirmed','unpaid'],
            ['LG-B00112','Ice B. Holand','Deluxe','105','Deluxe 105','Airport Pickup','4 nights',$dm(19),$dm(23),150,750,'pending','paid'],
            ['LG-B00113','Sarah Johnson','Standard','305','Standard 305','High Floor','2 nights',$dm(20),$dm(22),100,200,'confirmed','paid'],
            ['LG-B00114','Kevin Lee','Suite','306','Suite 306','None','3 nights',$dm(20),$dm(23),250,750,'confirmed','unpaid'],
            ['LG-B00115','Laura Martin','Deluxe','107','Deluxe 107','Extra Towels','1 nights',$dm(20),$dm(21),150,150,'confirmed','paid'],
            ['LG-B00116','Robert King','Standard','208','Standard 208','Late Check-Out','2 nights',$dm(21),$dm(23),100,200,'pending','unpaid'],
            ['LG-B00117','Olivia White','Suite','310','Suite 310','Airport Pickup','4 nights',$dm(21),$dm(25),250,1250,'confirmed','paid'],
            ['LG-B00118','Davis Bergson','Deluxe','110','Deluxe 110','Early Check-In','3 nights',$dm(21),$dm(24),150,150,'pending','paid'],
            ['LG-B00119','Martin Curtis','Standard','209','Standard 209','None','5 nights',$dm(22),$dm(27),100,500,'confirmed','unpaid'],
        ];
        foreach ($bk as $b) {
            Booking::create(['code'=>$b[0],'guest_name'=>$b[1],'room_type'=>$b[2],'room_number'=>$b[3],'room_label'=>$b[4],'request'=>$b[5],'duration'=>$b[6],'check_in'=>$b[7],'check_out'=>$b[8],'price_per_night'=>$b[9],'amount'=>$b[10],'status'=>$b[11],'invoice_status'=>$b[12]]);
        }

        // room, type, status, priority, floor, reservation, notes, checked
        $hk = [
            ['Room 101','Deluxe','progress','high','1st','Checked-In','Guest requested extra towels and pillows.',0],
            ['Room 102','Standard','ready','low','1st','Reserved','Ensure room is stocked with amenities.',0],
            ['Room 103','Suite','needs','high','2nd','Checked-Out','Deep clean due to extended stay.',0],
            ['Room 201','Standard','progress','medium','2nd','Checked-In','Guest requested fresh linens.',0],
            ['Room 202','Standard','needs','medium','2nd','Checked-Out','Ensure bathroom amenities are replenished.',0],
            ['Room 203','Deluxe','ready','low','2nd','Reserved','Check minibar supplies and restock if necessary.',0],
            ['Room 301','Suite','inspect','medium','3rd','Checked-Out','Verify that all electronics are functioning properly.',0],
            ['Room 302','Deluxe','progress','high','3rd','Checked-In','Guest reported a spill on the carpet.',0],
            ['Room 303','Suite','ready','low','3rd','Reserved','Ensure all towels are replaced.',0],
            ['Room 304','Standard','needs','medium','3rd','Checked-Out','Check for any maintenance issues.',0],
            ['Room 305','Deluxe','progress','medium','3rd','Checked-In','Verify that the mini-fridge is filled with refreshments.',0],
            ['Room 401','Deluxe','ready','low','4th','Reserved','Make sure the coffee & tea station is fully equipped.',0],
            ['Room 402','Standard','inspect','medium','4th','Checked-Out',"Replenish the room's amenities.",0],
        ];
        foreach ($hk as $h) {
            HousekeepingTask::create(['room_number'=>$h[0],'room_type'=>$h[1],'status'=>$h[2],'priority'=>$h[3],'floor'=>$h[4],'reservation_status'=>$h[5],'notes'=>$h[6],'is_checked'=>$h[7]]);
        }

        $inv = [
            ['Bath Towels','🧻','Linen','available',120,50,0],
            ['Shampoo Bottles','🧴','Toiletries','low',20,100,0],
            ['Coffee Pods','☕','Refreshments','out',0,200,1],
            ['Room Key Cards','🎫','Electronics','available',500,100,0],
            ['Cleaning Supplies','🧹','Housekeeping','available',300,50,0],
            ['Mini Bar Snacks','🍫','Refreshments','low',15,50,0],
            ['Bed Linens','🛏️','Linen','available',80,30,0],
            ['Bathrobes','🥼','Linen','low',10,50,0],
            ['Slippers','🥿','Guest Comfort','available',150,50,0],
            ['Water Bottles','💧','Refreshments','available',200,100,0],
            ['Kettle','🫖','Kitchen','out',0,130,0],
        ];
        foreach ($inv as $i) {
            InventoryItem::create(['name'=>$i[0],'emoji'=>$i[1],'category'=>$i[2],'availability'=>$i[3],'quantity_stock'=>$i[4],'quantity_reorder'=>$i[5],'is_checked'=>$i[6]]);
        }

        // title, category, date, start, end
        $sc = [
            ['Room Inspection','maintenance',$dm(1),'11:00 AM','1:00 PM'],
            ['Fire Safety Training','training',$dm(5),'2:00 PM','4:00 PM'],
            ['VIP Guest Arrival','meeting',$dm(7),'12:00 PM',null],
            ['Team Building Activity','event',$dm(10),'3:00 PM','5:00 PM'],
            ['Inventory Check','maintenance',$dm(12),'9:00 AM','1:00 PM'],
            ['Housekeeping Training','training',$dm(15),'11:00 AM','1:00 PM'],
            ['Marketing Strategy Meeting','meeting',$dm(18),'10:00 AM','12:00 PM'],
            ['Staff Meeting','meeting',$dm(20),'9:00 AM','10:00 AM'],
            ['Guest Welcome Event','guest',$dm(21),'6:00 PM','8:00 PM'],
            ['Maintenance Check','maintenance',$dm(23),'11:00 AM','1:00 PM'],
            ['Fire Drill','maintenance',$dm(24),'3:00 PM','4:00 PM'],
            ['Monthly Performance Review','meeting',$dm(29),'11:00 AM','1:00 PM'],
            ['End of Month Celebration','event',$dm(30),'5:00 PM','7:00 PM'],
        ];
        foreach ($sc as $s) {
            Schedule::create(['title'=>$s[0],'category'=>$s[1],'date'=>$s[2],'start_time'=>$s[3],'end_time'=>$s[4]]);
        }

        $ex = [
            ['Housekeeping Supplies','Supplies',10,500,$dm(1)],
            ['Electricity Bill','Utilities',1,1000,$dm(2)],
            ['Marketing Campaign','Marketing and Advertising',1,2000,$dm(3)],
            ['Room Maintenance','Maintenance and Repairs',3,1200,$dm(4)],
            ['Staff Salaries','Salaries and Wages',20,15000,$dm(5)],
            ['Water Bill','Utilities',1,500,$dm(6)],
            ['Event Supplies','Supplies',5,750,$dm(7)],
            ['Plumbing Repair','Maintenance and Repairs',1,800,$dm(8)],
            ['Internet Service','Utilities',1,300,$dm(9)],
            ['Print Advertisements','Marketing and Advertising',1,500,$dm(10)],
        ];
        foreach ($ex as $e) {
            Expense::create(['name'=>$e[0],'category'=>$e[1],'quantity'=>$e[2],'amount'=>$e[3],'date'=>$e[4],'status'=>'completed']);
        }

        $co = [
            ['Bebe W. Cullen','ELG001','Head Concierge','Monday - Friday','8 AM - 4 PM','+1 (555) 234-5678','bebe.cullen@example.com'],
            ['Alwar King','ELG002','Concierge','Monday - Friday','12 PM - 8 PM','+1 (555) 345-6789','alwar.king@example.com'],
            ['Sarah May','ELG003','Concierge','Saturday - Sunday','8 AM - 4 PM','+1 (555) 456-7890','sarah.may@example.com'],
            ['Gavin Timberbolt','ELG004','Concierge','Saturday - Sunday','12 PM - 8 PM','+1 (555) 567-8901','gavin.timberbolt@example.com'],
            ['Francesca Illing','ELG005','Concierge','Monday - Friday','8 AM - 4 PM','+1 (555) 678-9012','francesca.illing@example.com'],
            ['Joan Laster','ELG006','Concierge','Monday - Friday','12 PM - 8 PM','+1 (555) 789-0123','joan.laster@example.com'],
            ['Odena Berg','ELG007','Concierge','Saturday - Sunday','8 AM - 4 PM','+1 (555) 890-1234','odena.berg@example.com'],
            ['Kevin Nicolas','ELG008','Concierge','Saturday - Sunday','12 PM - 8 PM','+1 (555) 901-2345','vinnicolas@example.com'],
            ['Beatrice White','ELG009','Concierge','Monday - Friday','8 AM - 4 PM','+1 (555) 012-3456','beatrice.white@example.com'],
            ['Vincent Snow','ELG010','Concierge','Monday - Friday','12 PM - 8 PM','+1 (555) 123-4567','vincent.snow@example.com'],
            ['Rafael Bartoletti','ELG011','Concierge','Monday - Friday','12 PM - 8 PM','+1 (555) 896-1019','rafael98@example.com'],
        ];
        foreach ($co as $c) {
            Concierge::create(['name'=>$c[0],'code'=>$c[1],'position'=>$c[2],'schedule_days'=>$c[3],'schedule_time'=>$c[4],'contact'=>$c[5],'email'=>$c[6],'status'=>'active']);
        }

        $rv = [
            ['Johan Manulang',5,$dmf(15),'"Fantastic stay! The room was exceptionally clean and comfortable, and the staff were incredibly helpful and friendly. The location was perfect for our needs. Highly recommend this hotel to anyone visiting the area."'],
            ['Suzi Matsuda',4,$dmf(12),'"Great location and very friendly staff. The room was cozy and well-maintained. The breakfast could have offered more variety, but overall, it was a very good experience. I would stay here again."'],
            ['Donnie Wong',3,$dmf(10),'"The room was nice and the bed was comfortable, but there were some maintenance issues. The air conditioning was not working properly, which made the room quite warm at night."'],
            ['Isla de Lacosta',5,$dmf(8),'"Amazing service and a beautiful hotel. The amenities were top-notch, especially the spa, which I thoroughly enjoyed. The staff were very attentive and made my stay truly memorable. Will definitely return!"'],
        ];
        foreach ($rv as $r) {
            Review::create(['customer_name'=>$r[0],'rating'=>$r[1],'date'=>$r[2],'text'=>$r[3]]);
        }

        Task::insert([
            ['date'=>$dmf(19),'title'=>'Set Up Conference Room B for 10 AM Meeting','highlighted'=>0,'done'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['date'=>$dmf(19),'title'=>'Restock Housekeeping Supplies on 3rd Floor','highlighted'=>1,'done'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['date'=>$dmf(20),'title'=>'Inspect and Clean the Pool Area','highlighted'=>0,'done'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['date'=>$dmf(20),'title'=>'Check-In Assistance During Peak Hours (4 PM - 6 PM)','highlighted'=>0,'done'=>0,'created_at'=>now(),'updated_at'=>now()],
        ]);

        Activity::insert([
            ['time'=>'12:00 PM','title'=>'Conference Room Setup','description'=>'Events Team set up Conference Room B for 10 AM meeting, including AV equipment and refreshments.','icon'=>'lime','created_at'=>now(),'updated_at'=>now()],
            ['time'=>'11:30 AM','title'=>'Guest Check-Out','description'=>'Sarah Johnson completed check-out process and updated room availability for Room 305.','icon'=>'mint','created_at'=>now(),'updated_at'=>now()],
            ['time'=>'11:00 AM','title'=>'Room Cleaning Completed','description'=>'Maria Gonzalez cleaned and prepared Room 204 for new guests.','icon'=>'lime','created_at'=>now(),'updated_at'=>now()],
            ['time'=>'10:30 AM','title'=>'Maintenance Request Logged','description'=>'Broken toilet in Room 109, maintenance request assigned to technician.','icon'=>'mint','created_at'=>now(),'updated_at'=>now()],
            ['time'=>'10:00 AM','title'=>'Guest Check-In','description'=>'Angus Copper completed check-in process and issued room key.','icon'=>'lime','created_at'=>now(),'updated_at'=>now()],
        ]);

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
