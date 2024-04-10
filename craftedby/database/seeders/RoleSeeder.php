<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name'=>'Admin']);
        $role2 = Role::create(['name'=>'Artisan']);
        $role3 = Role::create(['name'=>'Authenticated_Client']);

        permission::create(['name'=> 'artisan.product.index']);
        permission::create(['name'=> 'artisan.product.create']);
        permission::create(['name'=> 'artisan.product.edit']);
        permission::create(['name'=> 'artisan.product.destroy']);

        permission::create(['name'=> 'artisan.shop']);

        permission::create(['name'=> 'client.product.index']);


    }
}
