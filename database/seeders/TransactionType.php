<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionType extends Seeder
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
            ],
        ];
        DB::table('transaction_types')->insert($data);

    }
}
