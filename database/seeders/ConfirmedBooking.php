<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfirmedBooking extends Seeder
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
                'payment_method_id' => 1,
                'confirm_date' => now(),
                'total_payment' => 1,
                'price_per_hour' => 1,
                'total_services_price' => 1.1,
                'created_by' => 1,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('confirmed_bookings')->insert($data);

    }
}
