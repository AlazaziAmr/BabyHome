<?php

namespace Database\Seeders;

use App\Models\Api\Admin\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Admin::create([
            "name" => 'admin',
            "username" => 'admin',
            "email" => 'admin@babyhome.com',
            "phone" => '010000000000',
            'password' => bcrypt('123456'),
        ]);
    }
}
