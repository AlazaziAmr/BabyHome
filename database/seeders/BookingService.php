<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingService extends Seeder
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
                'booking_id' => 1,
                'service_id' => 1,
                'master_id' => 1,
                'child_id' => 1,
                'service_type_id' => 1,
                'service_price' => 1.1,
                'service_quantity' => 1,
                'notes' => 'test',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('booking_services')->insert($data);

    }
}
