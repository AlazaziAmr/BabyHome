<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Booking extends Seeder
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
                'nursery_id'=>1,
                'master_id' => 1,
                'child_id' => 1,
                'status_id' => 1,
                'booking_date' => now(),
                'start_datetime' => now(),
                'end_datetime' => now(),
                'total_hours' => 4,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('bookings')->insert($data);

    }
}
