<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Transaction extends Seeder
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
                'confirmed_bookings_id'=>1,
                'transaction_id'=>1,
                'total_payment'=>1.1,
                'from_account'=>'From Transaction Test',
                'to_account'=>'To Transaction Test',
                'date'=>now(),
                'notes'=>'Notes Transaction Test',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('transactions')->insert($data);

    }
}
