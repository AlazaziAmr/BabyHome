<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageTypesSeeder extends Seeder
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
                    'ar' => 'ساعه',
                    'en' => 'hour',
                ]),
                'is_active' => 1,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'يومي',
                    'en' => 'dayly',
                ]),

                'is_active' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'أسبوعي',
                    'en' => 'weekly',
                ]),
                'is_active' => 0,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'شهري',
                    'en' => 'monthly',
                ]),
                'is_active' => 0,

                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        DB::table('packages_types')->insert($data);
    }
}
