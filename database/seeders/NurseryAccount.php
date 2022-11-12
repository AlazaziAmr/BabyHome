<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NurseryAccount extends Seeder
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
                'account_number'=>'Nursery Account test',
                'balance'=>1.1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('nursery_accounts')->insert($data);

    }
}
