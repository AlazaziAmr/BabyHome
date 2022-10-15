<?php

namespace Database\Seeders;

use App\Models\Api\Admin\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class InspectorRoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $entities = collect([
            'home',
            'admin',
            'role',
            'nurseries',
            'inspections',
            'countries',
            'cities',
            'activities',
            'service types',
            'packages',
            'package types',
            'bancks',
            'days',
            'genders',
            'languages',
            'neighborhoods',
            'qualifications',
            'relations',
            'masters',
            'children',
            'restore-user',
        ]);

        $entities->each(function ($item, $key) {
            Permission::firstOrCreate([
                'name' => 'view ' . $item,
            ], ['name' => 'view ' . $item, 'guard_name' => 'admin']);
            Permission::firstOrCreate([
                'name' => 'create ' . $item,
            ], ['name' => 'create ' . $item, 'guard_name' => 'admin']);
            Permission::firstOrCreate([
                'name' => 'edit ' . $item,
            ], ['name' => 'edit ' . $item, 'guard_name' => 'admin']);
            Permission::firstOrCreate([
                'name' => 'delete ' . $item,
            ], ['name' => 'delete ' . $item, 'guard_name' => 'admin']);
        });

        // Create a Admin Role and assign all Permissions
        $inspector = Role::firstOrCreate([
            'name'       => 'inspector',
            'guard_name' => 'admin',
        ]);

//        $inspector = Role::firstOrCreate([
//            'name'       => 'inspector',
//            'guard_name' => 'admin',
//        ]);

        $inspector->givePermissionTo(Permission::where('guard_name', 'admin')->get());

        $inspectorAccount = Admin::create([
            'name' => 'inspector test',
            'username' => 'inspector',
            'email' => 'inspector@app.com',
            'phone' => '123456',
            'password' => bcrypt('123456'),
            'fcm_token' => ''
        ]);
        $inspectorAccount->assignRole('inspector');
    }
}
