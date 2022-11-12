<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethod extends Seeder
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
                    'ar' => 'إختبار ',
                    'en' => ' Test',
                ]),
                'flag'=>1,
                'status'=>1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('payment_methods')->insert($data);

    }
}
