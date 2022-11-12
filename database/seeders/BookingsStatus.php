<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingsStatus extends Seeder
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
                    'ar' => 'حجز إختبار',
                    'en' => 'Booking Test',
                ]),
                'description'=>'description test',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('booking_status')->insert($data);

    }
}
