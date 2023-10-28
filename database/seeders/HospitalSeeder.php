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
                'name' =>'Trauma Centre',
            ],
            [
                'name' =>'PBM Super Speciality Hospital',
            ],
            [
                'name' =>'PBM Eye Hospital',
            ],
            [
                'name' =>"PBM Men's Hospital",
            ],
            [
                'name' =>'PBM Women Hospital',
            ],
            [
                'name' =>'OPD wing, PBM hospital',
            ],
            [
                'name' =>'TB Hospital PBM',
            ],
            [
                'name' =>'ENT PBM hospital',
            ],
            [
                'name' =>'OPD Medicine And Surgery',
            ],
            [
                'name' =>'Eye Ear Nose PBM Hospital',
            ],
            [
                'name' =>'E-Ward PBM',
            ],
            [
                'name' =>"Prince Bijay Singh Memorial Children's Hospital",
            ],
            [
                'name' =>'Original PBM Hospital',
            ],
            [
                'name' =>'Rehabilitation center PBM HOSPITAL',
            ]
            ]);
    }
}
