<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

        class RoleAndPermissionSeeder extends Seeder
        {
            /**
             * Run the database seeds.
             *
             * @return void
             */
            public function run()
            {
                app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

                // permissions for category Crud
                Permission::create(['name' => 'index category']);
                Permission::create(['name' => 'show category']);
                Permission::create(['name' => 'create category']);
                Permission::create(['name' => 'edit category']);
                Permission::create(['name' => 'delete category']);

                // permission for games crud
                Permission::create(['name' => 'index games']);
                Permission::create(['name' => 'show games']);
                Permission::create(['name' => 'create games']);
                Permission::create(['name' => 'edit games']);
                Permission::create(['name' => 'delete games']);


                // User Role
                $user = Role::create(['name' => 'user']);


                //Salesperson role
                $salesperson= Role::create(['name' => 'salesperson'])
                    ->givePermissionTo(['index games', 'show games', 'create games', 'edit games', 'delete games']);

                //admin role
                $admin = Role::create(['name' => 'admin'])
                    ->givePermissionTo(Permission::all());
            }


}
