<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'product-list',
           'product-create',
           'product-edit',
           'product-delete'
        ];
        $role = Role::create(['name' => 'superadmin']); //Tao role
        $role->givePermissionTo($permissions); //Gan permission vao role

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('product-list', 'product-create', 'product-edit', 'product-delete');

        $role = Role::create(['name' => 'member']);
        $role->givePermissionTo('product-list');
    }
}
