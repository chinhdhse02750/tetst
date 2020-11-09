<?php

use App\Entities\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        if (Permission::count() === 0) {
            Permission::create(['name' => 'show_dashboard', 'guard_name' => 'admin']);
            Permission::create(['name' => 'create_user', 'guard_name' => 'admin']);
            Permission::create(['name' => 'search_user', 'guard_name' => 'admin']);
            Permission::create(['name' => 'edit_user', 'guard_name' => 'admin']);
            Permission::create(['name' => 'leave_user', 'guard_name' => 'admin']);
            Permission::create(['name' => 'restore_user', 'guard_name' => 'admin']);
            Permission::create(['name' => 'add_point_user', 'guard_name' => 'admin']);
            Permission::create(['name' => 'balances_management', 'guard_name' => 'admin']);
            Permission::create(['name' => 'offer_management', 'guard_name' => 'admin']);
            Permission::create(['name' => 'edit_contact', 'guard_name' => 'admin']);
            Permission::create(['name' => 'content_management', 'guard_name' => 'admin']);
            Permission::create(['name' => 'master_data_management', 'guard_name' => 'admin']);
            Permission::create(['name' => 'account_management', 'guard_name' => 'admin']);
            Permission::create(['name' => 'setting_management', 'guard_name' => 'admin']);
        }

        if (Role::count() === 0) {
            $roleAdmin = Role::create(['name' => 'admin', 'guard_name' => 'admin']);
            $roleSuperAdmin = Role::create(['name' => 'super_admin', 'guard_name' => 'admin']);

            $roleAdmin->givePermissionTo(
                'show_dashboard',
                'create_user',
                'search_user',
                'edit_user',
                'add_point_user',
                'edit_contact',
                'content_management'
            );
        }
    }
}
