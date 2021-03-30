<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesYPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'create post']);
        Permission::create(['name' => 'read post']);
        Permission::create(['name' => 'delete post']);

        Permission::create(['name' => 'create message']);
        Permission::create(['name' => 'read message']);
        Permission::create(['name' => 'delete message']);

        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'read roles']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);

        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'read permissions']);
        Permission::create(['name' => 'update permission']);
        Permission::create(['name' => 'delete permission']);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'lector']);
        $role->givePermissionTo('read post');
        $role->givePermissionTo('read message');

        $role = Role::create(['name' => 'escritor']);
        $role->givePermissionTo('create post');
        $role->givePermissionTo('read post');
        $role->givePermissionTo('create message');
        $role->givePermissionTo('read message');

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
    }
}
