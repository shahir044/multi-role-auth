<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Let's Create User and assign Role to it.
        $superAdminRole = Role::where('name', 'super-admin')->first();
        $superAdminUser = User::firstOrCreate([
            'email' => 'shahir.rahman@biman.gov.bd',
        ], [
            'name' => 'Super Admin',
            'email' => 'shahir.rahman@biman.gov.bd',
            'password' => Hash::make ('12345678'),
            'mobile' => '01931131690',
            'nid' => '8252562221',
            'pg_no' => '52044'
        ]);

        $superAdminUser->assignRole($superAdminRole);
    }
}
