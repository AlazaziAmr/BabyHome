<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemAccount extends Seeder
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
                'account_name'=>'system name test',
                'account_number'=>'system number test',
                'balance'=>1.1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('system_accounts')->insert($data);

    }
}
