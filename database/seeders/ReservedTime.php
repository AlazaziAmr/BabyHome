<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservedTime extends Seeder
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
                'date'=>date(),
                'start_hour'=>time(),
                'end_hour'=>time(),
                'num_of_confirmed_res'=>1,
                'num_of_unconfirmed_res'=>1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('reserved_times')->insert($data);

    }
}
