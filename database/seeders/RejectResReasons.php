<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RejectResReasons extends Seeder
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
                'booking_id'=>1,
                'reason'=>'reason test',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('reject_res_reasons')->insert($data);

    }
}
