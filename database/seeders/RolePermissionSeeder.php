<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];

        DB::beginTransaction();
        try {
            $applicant = User::create(array_merge([
                'name' => 'Bagas Ardiansyah',
                'email' => 'bagasardi123@gmail.com',
            ], $default_user_value));
    
            $admin = User::create(array_merge([
                'name' => 'Administrator',
                'email' => 'admin@pendaftaranmerk.com',
            ], $default_user_value));
    
            $role = Role::create(['name' => 'applicant']);
            $role = Role::create(['name' => 'admin']);
    
            $permission = Permission::create(['name' => 'create role']);
            $permission = Permission::create(['name' => 'read role']);
            $permission = Permission::create(['name' => 'update role']);
            $permission = Permission::create(['name' => 'delete role']);
    
            $applicant->assignRole('applicant');
            $admin->assignRole('admin');
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
