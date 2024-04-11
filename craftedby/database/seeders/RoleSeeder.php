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

        permission::create(['name'=> 'admin.users.index'])->syncRoles([$role1]);

        permission::create(['name'=> 'products.show'])->syncRoles([$role1,$role2]);
        permission::create(['name'=> 'product.create'])->syncRoles([$role1,$role2]);
        permission::create(['name'=> 'artisan.product.edit'])->syncRoles([$role1,$role2]);
        permission::create(['name'=> 'artisan.product.destroy'])->syncRoles([$role1,$role2]);



//        $role1 ->permissions()->attach([1,2,3,4,5,6]);


    }
}
