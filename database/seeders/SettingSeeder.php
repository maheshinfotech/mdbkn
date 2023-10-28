<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::Insert([
            'check_in_time' => '8:00',
            'check_out_time' => '8:00',
            'grace_period' => '2',

        ]);
    }
}
