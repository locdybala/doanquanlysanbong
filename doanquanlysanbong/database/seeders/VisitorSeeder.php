<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake  = Factory::create();
        $limit = 50;
        for ($i = 0; $i < $limit; $i++){
            DB::table('visitors')->insert([
                'ip_address' => $fake->numerify($string = '###.###.###'),
                
                'date_visitor' => $fake->date("Y-m-d"),
            ]);
        }
    }
}
