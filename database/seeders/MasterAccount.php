<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterAccount extends Seeder
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
                'master_id'=>1,
                'account_number' => 1,
                'balance' => 1.1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('master_accounts')->insert($data);

    }
}
