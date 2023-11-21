<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('menus')->truncate();

        DB::insert(DB::raw(
            " INSERT INTO `menus` (`id`, `menu_name`, `menu_href`, `menu_parent`, `menu_icon`, `menu_placeholder`, `menu_permissions`, `is_active`, `created_at`, `updated_at`, `deleted_at`, `is_section`, `order`)
                VALUES
                (1, 'dashboard', 'dashboard', 0, '<i class=\"fa-solid fa-gauge-high\"></i>', 'dashboard', '1', 1, NULL, NULL, NULL, 0, 1),
                (2, 'rooms', 'room', 0, '<i class=\"fa-solid fa-person-shelter\"></i>', 'Rooms', '1,2,3', 1, NULL, NULL, NULL, 0, 2),
                (3, 'booking', 'bookings', 0, '<i class=\"fa-solid fa-person-shelter\"></i>', 'Add_Bookings', '1,2,3,4', 1, NULL, NULL, NULL, 0, 3),
                (4, 'category', 'category', 0, '<i class=\"fa-solid fa-person-shelter\"></i>', 'category', '1,2,3,4', 1, NULL, NULL, NULL, 0, 6),
                (5, 'user', 'user', 0, '<i class=\"fa-solid fa-users\"></i>', 'User', '1,2,3,4\r\n', 0, NULL, NULL, NULL, 0, 5),
                (6, 'parking', 'parkings', 0, '<i class=\"fa-solid fa-person-shelter\"></i>', 'Parkings', '1,2,3,4', 1, NULL, NULL, NULL, 0, 4);"
        ));
    }
}
