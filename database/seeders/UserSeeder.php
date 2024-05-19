<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'full_name' => 'Admin',
            'nickname' => 'Admin',
            'gender' => 'Pria',
            'employee_id' => 'Administrator',
            'title' => "Administrator",
            'phone_number' => '-',
            'email' => 'admin@mitoindonesia.com',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'branch_id' => 1,
        ]);
        
        User::create([
            'full_name' => 'Taufan',
            'nickname' => 'Taufan',
            'gender' => 'Pria',
            'employee_id' => '0819.01.1.1.1.001',
            'title' => 'Director',
            'phone_number' => '0813 1345 2451',
            'email' => 'taufan@mitoindonesia.com',
            'username' => 'taufan',
            'password' => Hash::make('taufan@2410'), //nickname + @ + birth date
            'branch_id' => 1,
        ]);

        User::create([
            'full_name' => 'Erton Tito Hutagaol',
            'nickname' => 'Erton',
            'gender' => 'Pria',
            'employee_id' => '1021.06.3.1.1.035',
            'title' => "Head of Sales & Marketing",
            'phone_number' => '0853 6317 2525',
            'email' => 'erton@mitoindonesia.com',
            'username' => 'erton',
            'password' => Hash::make('erton@1806'),
            'branch_id' => 1,
        ]);

        User::create([
            'full_name' => 'Gea Nabila Sari',
            'nickname' => 'Gea',
            'gender' => 'Perempuan',
            'employee_id' => '0822.07.5.1.1.051',
            'title' => 'Admin Sales',
            'phone_number' => '0823 8481 6321',
            'email' => 'gea@mitoindonesia.com',
            'username' => 'gea',
            'password' => Hash::make('gea@0908'),
            'branch_id' => 1,
        ]);

        User::create([
            'full_name' => 'Sintia Lestari',
            'nickname' => 'Sintia',
            'gender' => 'Perempuan',
            'employee_id' => '0323.07.6.1.1.065',
            'title' => "Sales & Marketing",
            'phone_number' => '0813 1345 2451',
            'email' => 'sintia@mitoindonesia.com',
            'username' => 'sintia',
            'password' => Hash::make('sintia@2102'),
            'branch_id' => 1,
        ]);

        User::create([
            'full_name' => 'Yudha Satria',
            'nickname' => 'Yudha',
            'gender' => 'Pria',
            'employee_id' => '0723.07.6.1.1.072',
            'title' => "Sales & Marketing",
            'phone_number' => '0853 6387 7814',
            'email' => 'yudhasatria@mitoindonesia.com',
            'username' => 'yudhasatria',
            'password' => Hash::make('yudhasatria@1012'),
            'branch_id' => 1,
        ]);

        User::find(1)->assignRole('Super Admin');
    }
}
