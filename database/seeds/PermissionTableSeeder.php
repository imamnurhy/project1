<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'master-role',
            'master-pegawai',
            'master-jabatan',
            'master-unitkerja'
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $permissions = Permission::pluck('id')->all();

        $role = Role::create(['name' => 'superadmin']);
        $role->syncPermissions($permissions);

        $user = User::create([
            'username' => 'admin',
            'password' => bcrypt('1234'),
            'lastlogin' => 0,
            'status' => '1'
        ]);
        $user->assignRole($role->name);
    }
}
