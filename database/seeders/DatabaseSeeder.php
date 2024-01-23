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


        \App\Models\User::Insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  //password
            'is_active' => 1,
            'role_id' => 1
        ]);
        $this->call([
            MenuSeeder::class,
            RoomCategoriesSeeder::class,
            RoomSeeder::class,
            SettingSeeder::class,
            HospitalSeeder::class
        ]);
    }
}
