<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
         Permission::create(['name' => 'CUD movies']);
         Permission::create(['name' => 'read movies']);

        // create permissions
        Permission::create(['name' => 'CUD actors']);
        Permission::create(['name' => 'read actors']);


        Permission::create(['name' => 'CUD categories']);
        Permission::create(['name' => 'read categories']);

        Permission::create(['name' => 'CRUD users']);


        Permission::created(['name'=> 'edite role']);
        Permission::created(['name'=> 'delete role']);
        Permission::created(['name'=> 'get role']);
        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'simple-user']);
        $role->givePermissionTo(['read movies','read actors','read categories']);

        // or may be done by chaining
        $role = Role::create(['name' => 'moderator'])
            ->givePermissionTo(['read movies','CUD movies','read actors','CUD actors','CUD categories','read categories']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
