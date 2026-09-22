<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\HousekeepingTask;
use App\Models\Room;
use App\Models\RoomUnit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Real property data for Indus Resort, Murree Bhurban.
 * Sources: the resort website (room names, prices, descriptions, photos) and the
 * Lodgify requirements questionnaire (2 floors, executive double-bed rooms at PKR 15,000,
 * 8-person portions at PKR 35,000 / 30,000).
 *
 * Re-runnable on its own: `php artisan db:seed --class=IndusResortSeeder`
 * It replaces room types, room numbers, housekeeping rows and clears demo bookings/guests.
 * Inventory, expenses, staff, reviews and calendar data are left untouched.
 */
class IndusResortSeeder extends Seeder
{
    public const FACILITIES = ['High-speed Wi-Fi', 'In-room safe', 'Mini-fridge', 'Flat-screen TV', 'Air conditioning', 'Coffee/tea maker'];
    public const AMENITIES = ['Complimentary bottled water', 'Luxury toiletries', 'Coffee and tea making facilities', 'Hairdryer', 'Premium bedding and linens', 'Bathrobe and slippers', 'Ensuite bathroom with shower and bathtub', '24-hour room service'];

    /** Room types, each with the room numbers (units) and the floor they sit on. */
    public static function rooms(): array
    {
        $img = fn ($n) => 'images/rooms/'.$n.'.jpg';

        return [
            [
                'name' => '3 Room Portion (Mountain View)', 'size' => '10 Marla', 'bed' => '3 Bedrooms', 'guests' => '8 guests', 'price' => 35000,
                'description' => 'A spacious 3-bedroom portion with a cozy TV lounge and dining area, opening onto a private balcony with breathtaking mountain views.',
                'features' => ['3 Bedrooms', 'TV Lounge', 'Dining Area', 'Balcony with Mountain View', 'No Kitchen'],
                'image' => $img('mountain-view-main'),
                'gallery' => [$img('mountain-view-main'), $img('mountain-view-1'), $img('mountain-view-2'), $img('mountain-view-3'), $img('mountain-view-4'), $img('mountain-view-5'), $img('mountain-view-6')],
                'is_featured' => true,
                'units' => ['MV-1'], 'floor' => 'First',
            ],
            [
                'name' => '3 Room Portion (Lawn Access)', 'size' => '10 Marla', 'bed' => '3 Bedrooms', 'guests' => '8 guests', 'price' => 30000,
                'description' => 'Perfect for families and groups, this 3-bedroom portion features a TV lounge, dining area and direct access to a private lawn.',
                'features' => ['3 Bedrooms', 'TV Lounge', 'Dining Area', 'Private Lawn Access', 'No Kitchen'],
                'image' => $img('lawn-access-main'),
                'gallery' => [$img('lawn-access-main'), $img('lawn-access-1'), $img('lawn-access-2'), $img('lawn-access-3')],
                'is_featured' => false,
                'units' => ['LA-1'], 'floor' => 'Ground',
            ],
            [
                'name' => '2 Rooms Suite', 'size' => '2 Bedrooms', 'bed' => '2 Double Beds', 'guests' => '4 guests', 'price' => 22000,
                'description' => 'A comfortable 2-bedroom suite with its own kitchen, TV lounge, dining area and a huge balcony to relax and enjoy the view.',
                'features' => ['2 Bedrooms', 'Kitchen', 'TV Lounge', 'Dining Area', 'Huge Balcony'],
                'image' => $img('two-room-suite-main'),
                'gallery' => [$img('two-room-suite-main'), $img('two-room-suite-1'), $img('two-room-suite-2')],
                'is_featured' => false,
                'units' => ['SU-1'], 'floor' => 'First',
            ],
            [
                'name' => 'Executive Room', 'size' => '1 Bedroom', 'bed' => 'Double Bed', 'guests' => '3 guests', 'price' => 15000,
                'description' => 'A private executive room with a double bed and en-suite bathroom on the ground floor. Ideal for couples or a small family.',
                'features' => ['Double Bed', 'En-suite Bathroom', 'Work Desk', 'Modern Layout'],
                'image' => $img('executive-room-main'),
                'gallery' => [$img('executive-room-main'), $img('executive-room-1'), $img('executive-room-2')],
                'is_featured' => false,
                'units' => ['101', '102', '103'], 'floor' => 'Ground',
            ],
        ];
    }

    public function run()
    {
        DB::transaction(function () {
            // Demo bookings and guests go; they referenced the sample room types.
            Booking::query()->delete();
            Guest::query()->delete();
            HousekeepingTask::query()->delete();
            RoomUnit::query()->delete();
            Room::query()->delete();

            foreach (self::rooms() as $def) {
                $units = $def['units'];
                $floor = $def['floor'];
                unset($def['units'], $def['floor']);

                $room = Room::create($def + [
                    'status' => 'available',
                    'availability_used' => 0,
                    'availability_total' => count($units),
                    'facilities' => self::FACILITIES,
                    'amenities' => self::AMENITIES,
                ]);

                foreach ($units as $number) {
                    RoomUnit::create(['room_id' => $room->id, 'number' => $number, 'status' => 'available']);
                    HousekeepingTask::create([
                        'room_number' => 'Room '.$number, 'room_type' => $room->name, 'status' => 'ready', 'priority' => 'low',
                        'floor' => $floor, 'reservation_status' => 'Available', 'notes' => 'Ready for the next guest.', 'is_checked' => false,
                    ]);
                }
            }

            Room::syncCounts();
        });
    }
}
