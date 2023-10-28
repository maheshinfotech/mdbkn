<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // (2, 'user', 'user', 0, '<i class=\"fa-solid fa-users\"></i>', 'User', '1,2,3,4\r\n', 1, NULL, NULL, NULL, 0, 1),

        DB::insert(DB::raw(
            " INSERT INTO `menus` (`id`, `menu_name`, `menu_href`, `menu_parent`, `menu_icon`, `menu_placeholder`, `menu_permissions`, `is_active`, `created_at`, `updated_at`, `deleted_at`, `is_section`, `order`) VALUES
        (1, 'dashboard', 'dashboard', 0, '<i class=\"fa-solid fa-gauge-high\"></i>', 'dashboard', '1', 1, NULL, NULL, NULL, 0, 1),
        (2, 'rooms', 'room', 0, '<i class=\"fa-solid fa-person-shelter\"></i>', 'Rooms', '1,2,3', 1, NULL, NULL, NULL, 0, 1),
        (3, 'booking', 'bookings', 0, '<i class=\"fa-solid fa-person-shelter\"></i>', 'Bookings', '1,2,3,4', 1, NULL, NULL, NULL, 0, 1),
        (4, 'category', 'category', 0, '<i class=\"fa-solid fa-person-shelter\"></i>', 'category', '1,2,3,4', 1, NULL, NULL, NULL, 0, 1),
        (5, 'user', 'user', 0, '<i class=\"fa-solid fa-users\"></i>', 'User', '1,2,3,4\r\n', 0, NULL, NULL, NULL, 0, 1);"
        ));

        \App\Models\User::Insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  //password
            'is_active' => 1,
            'role_id' => 1
        ]);
        $this->call([
            RoomCategoriesSeeder::class,
            RoomSeeder::class,
            SettingSeeder::class
        ]);
    }
}
