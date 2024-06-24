<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'first_name'=>'My',
            'last_name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('password'),
            'phone'=> '087861976',
            'profile' => 'user.avif'
        ]);

        $writer = User::create([
            'first_name'=>'My',
            'last_name'=>'User',
            'email'=>'user@gmail.com',
            'password'=>bcrypt('password'),
            'phone'=> '087861976',
            'profile'=> '1719084702_photo_2023-11-03_22-01-29.jpg'
        ]);
        

        $admin_role = Role::create(['name' => 'admin']);
        $writer_role = Role::create(['name' => 'user']);

        $permission = Permission::create(['name' => 'Role access']);
        $permission = Permission::create(['name' => 'Role edit']);
        $permission = Permission::create(['name' => 'Role create']);
        $permission = Permission::create(['name' => 'Role delete']);

        $permission = Permission::create(['name' => 'User access']);
        $permission = Permission::create(['name' => 'User edit']);
        $permission = Permission::create(['name' => 'User create']);
        $permission = Permission::create(['name' => 'User delete']);

        $permission = Permission::create(['name' => 'Permission access']);
        $permission = Permission::create(['name' => 'Permission edit']);
        $permission = Permission::create(['name' => 'Permission create']);
        $permission = Permission::create(['name' => 'Permission delete']);

        $permission = Permission::create(['name' => 'System access']);
        $permission = Permission::create(['name' => 'System edit']);
        $permission = Permission::create(['name' => 'System create']);
        $permission = Permission::create(['name' => 'System delete']);

        $permission = Permission::create(['name' => 'Notification access']);
        $permission = Permission::create(['name' => 'Notification edit']);
        $permission = Permission::create(['name' => 'Notification create']);
        $permission = Permission::create(['name' => 'Notification delete']);

        $permission = Permission::create(['name' => 'Mail access']);
        $permission = Permission::create(['name' => 'Mail edit']);
        

        $admin->assignRole($admin_role);
        $writer->assignRole($writer_role);


        $admin_role->givePermissionTo(Permission::all());
    }
}