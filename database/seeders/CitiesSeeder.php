<?php

namespace Database\Seeders;

use App\Models\Api\Generals\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $data = [
            [
                "name" => json_encode([
                    'ar' => 'الرياض',
                    'en' => 'Riyadh',
                ]),
                "country_id" => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('cities')->insert($data);

        $data = [
            [
                "name" => json_encode([
                    'ar' => 'الدقي',
                    'en' => 'Doki',
                ]),
                "city_id" => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('neighborhoods')->insert($data);
    }
}
