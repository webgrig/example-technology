<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class PermissionsSeeder extends Seeder
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
        Permission::create(['name' => 'control self companies']);
        Permission::create(['name' => 'control companies']);
        Permission::create(['name' => 'control sectors']);
        Permission::create(['name' => 'control users']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'manager']);
        $role1->givePermissionTo('control self companies');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('control companies');
        $role2->givePermissionTo('control self companies');
        $role2->givePermissionTo('control sectors');

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users

        $user = User::factory()->create([
            'name' => 'Super-Admin',
            'email' => 'superadmin@example.com',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'password' => '$2y$10$BMEw0c89NtT5rFd36teS8eAP1EvLeCQXg7nWVMYM8oXEYjIt3z1Sq',
        ]);
        $user->assignRole($role3);

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'password' => '$2y$10$BMEw0c89NtT5rFd36teS8eAP1EvLeCQXg7nWVMYM8oXEYjIt3z1Sq',
        ]);
        $user->assignRole($role2);

        $user = User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@example.com',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'password' => '$2y$10$BMEw0c89NtT5rFd36teS8eAP1EvLeCQXg7nWVMYM8oXEYjIt3z1Sq',
        ]);
        $user->assignRole($role1);
    }
}
