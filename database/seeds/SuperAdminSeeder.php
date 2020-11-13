<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Entities\Admin;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Admin::count() === 0) {
            DB::table('admins')->insert([
                'name' => "Admin",
                'email' => 'admin@tomosia.com',
                'password' => Hash::make('123456'),
                'last_login_ip' => \Request::ip(),
                'remember_token' => Str::random(60)
                ,
            ]);
        }

        if (Admin::where('email', 'admin@oriental-club.net')->count() === 0) {
            DB::table('admins')->insert([
                'name' => "Admin",
                'email' => 'admin@oriental-club.net',
                'password' => Hash::make('123456'),
                'last_login_ip' => \Request::ip(),
                'remember_token' => Str::random(60)
            ]);
        }

        if (Admin::where('email', 'admin@pw-unit.com')->count() === 0) {
            DB::table('admins')->insert([
                'name' => "Admin",
                'email' => 'admin@pw-unit.com',
                'password' => Hash::make('123456'),
                'last_login_ip' => \Request::ip(),
                'remember_token' => Str::random(60)
            ]);
        }

        DB::table('admins')
            ->whereIn('email', ['admin@oriental-club.net', 'admin@tomosia.com'])
            ->update(['password' => Hash::make('123456')]);

        $superAdmin1 = Admin::where('email', 'admin@oriental-club.net')->first();
        $superAdmin2 = Admin::where('email', 'admin@tomosia.com')->first();
        $superAdmin3 = Admin::where('email', 'admin@pw-unit.com')->first();
        $roleSuperAdmin = Role::where('name', 'super_admin')->get();
        if (!empty($superAdmin1)) {
            $superAdmin1->assignRole($roleSuperAdmin);
        }
        if (!empty($superAdmin2)) {
            $superAdmin2->assignRole($roleSuperAdmin);
        }
        if (!empty($superAdmin3)) {
            $superAdmin3->assignRole($roleSuperAdmin);
        }
    }
}
