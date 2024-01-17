<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hospitals')->insert([
            [
                'id' => 1,
                'name' =>'Medicine Hospital',
            ],
            [
                'id' => 2,
                'name' =>'Sarjan Hospital',
            ],
            [
                'id' => 3,
                'name' =>'Trauma center Hospital',
            ],
            [
                'id' => 4,
                'name' =>"Haldiram heart Hospital",
            ],
            [
                'id' => 5,
                'name' =>'Cancer Hospital',
            ],
            [ 'id' => 6,
                'name' =>'Nasha mukti Hospital',
            ],
            [
                'id' => 7,
                'name' =>'TB Hospital PBM',
            ],
            [
                'id' => 8,
                'name' =>'ENT PBM Hospital',
            ],
            [
                'id' => 9,
                'name' =>'PBM HHG super speciality Hospital',
            ],
            [
                'id' => 10,
                'name' =>'Urology Hospital',
            ],
            [
                'id' => 11,
                'name' =>'Eye  PBM Hospotal',
            ],
            [
                'id' => 12,
                'name' =>'Child Hospital',
            ],
            [
                'id' => 13,
                'name' =>'female Hospital',
            ],
            [
                'id' => 15,
                'name' =>'Others',
            ],
            ]);
    }
}
