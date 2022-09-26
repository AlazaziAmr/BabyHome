<?php

namespace Database\Seeders;

use App\Models\Api\Generals\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
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
                    'ar' => 'المملكة العربية السعودية',
                    'en' => 'Kingdom Saudi Arabia',
                ]),
                "flag" => "flag",
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('countries')->insert($data);
    }
}
