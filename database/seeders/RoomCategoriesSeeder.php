<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room_categories')->insert([
            [
                'name' => 'Initial',
                'facility' => 'WLBK',
                'description' => 'basic room with bed',
                'normal_rent' => 60,
                'patient_rent' => 40,
            ],
            [
                'name' => 'Basic',
                'facility' => 'LBK',
                'description' => 'Basic room with LBK bed',
                'normal_rent' => 120,
                'patient_rent' => 100,
            ],
            [
                'name' => 'Normal',
                'facility' => 'LBK',
                'description' => 'Normal room with LBK bed',
                'normal_rent' => 150,
                'patient_rent' => 120,
            ],
            [
                'name' => 'Premium',
                'facility' => 'LBK',
                'description' => 'Premium room with LBK bed',
                'normal_rent' => 210,
                'patient_rent' => 180,
            ],
            [
                'name' => 'Flats',
                'facility' => 'Big room and all facilities',
                'description' => 'Flat with big room and all facilities',
                'normal_rent' => 350,
                'patient_rent' => 300,
            ],

            [
               'name'=> 'Other',
               'facility' => null,
               'description'=> null,
               'normal_rent'=> null,
               'patient_rent'=> null,

            ]

        ]);
    }
}
