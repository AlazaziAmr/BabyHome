<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activities = [
            [
                "name" => json_encode([
                    'ar' => 'حل الواجبات',
                    'en' => 'Home Work Resolve',
                ]),
                'description' => 'حل الواجبات',
                'unit' => 'وحده',
                'price' => 0,
                'is_paid' => 0,
                'type_id' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'تعليم الحروف والارقام',
                    'en' => 'Alphabets & Numbers Learning',
                ]),
                'description' => 'تعليم الحروف والارقام',
                'unit' => 'وحده',
                'price' => 0,
                'is_paid' => 0,
                'type_id' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'حفظ اجزاء من القران الكريم',
                    'en' => 'Quran Memorization',
                ]),
                'description' => 'حفظ اجزاء من القران الكريم',
                'unit' => 'وحده',
                'price' => 0,
                'is_paid' => 0,
                'type_id' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'تعليم السباحة',
                    'en' => 'Swimming Training',
                ]),
                'description' => 'تعليم السباحة',
                'unit' => 'وحده',
                'price' => 0,
                'is_paid' => 0,
                'type_id' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'حصص رياضة',
                    'en' => 'Math classes',
                ]),
                'description' => 'حصص رياضة',
                'unit' => 'وحده',
                'price' => 0,
                'is_paid' => 0,
                'type_id' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'الرسم',
                    'en' => 'Drowing',
                ]),
                'description' => 'تعليم الرسم',
                'unit' => 'وحده',
                'price' => 0,
                'is_paid' => 0,
                'type_id' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "name" => json_encode([
                    'ar' => 'تعليم انجليزي',
                    'en' => 'English Classes',
                ]),
                'description' => 'تعليم انجليزي',
                'unit' => 'وحده',
                'price' => 0,
                'is_paid' => 0,
                'type_id' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        DB::table('activities')->insert($activities);
    }
}
