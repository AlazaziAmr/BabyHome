<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaysSeeder extends Seeder
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
                    'ar' => 'السبت',
                    'en' => 'saturday',
                ]),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'الأحد',
                    'en' => 'sunday',
                ]),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'الإثنين',
                    'en' => 'monday',
                ]),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'الثلاثاء',
                    'en' => 'tuesday',
                ]),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'الأربعاء',
                    'en' => 'wednesday',
                ]),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'الخميس',
                    'en' => 'thursday',
                ]),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'الجمعة',
                    'en' => 'friday',
                ]),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        DB::table('days')->insert($data);
    }
}
