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
                (2, 'rooms', 'room', 0, '<i class=\"fa-solid fa-person-shelter\"></i>', 'Rooms', '1,2,3,4', 1, NULL, NULL, NULL, 0, 3),
                (3, 'booking', 'bookings', 0, '<i class=\"fas fa-calendar-plus\"></i>', 'Add_Bookings', '1,2,3,4', 1, NULL, NULL, NULL, 0, 4),
                (4, 'category', 'category', 0, '<i class=\"fa fa-list-alt\"></i>', 'category', '1,2,3,4', 1, NULL, NULL, NULL, 0, 2),
                (5, 'user', 'users', 0, '<i class=\"fa-solid fa-user\"></i>', 'users', '1,2,3,4\r\n', 1, NULL, NULL, NULL, 0, 6),
                (6, 'parking', 'parkings', 0, '<i class=\"fas fa-parking \"></i>', 'Parkings', '1,2,3,4', 1, NULL, NULL, NULL, 0, 5),
                (7, 'permission', 'permissions', 0, '<i class=\"fa-solid fa-lock\"></i>', 'permissions', '1,2,3,4', 1, NULL, NULL, NULL, 0, 8),
                (8, 'role', 'roles', 0, '<i class=\"fa-solid fa-users\"></i>', 'roles', '1,2,3,4', 1, NULL, NULL, NULL, 0, 7)
                ;"
        ));
    }
}
