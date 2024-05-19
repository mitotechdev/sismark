<?php

namespace Database\Seeders;

use App\Models\Finance\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::create(['name' => '7 Hari']);
        Payment::create(['name' => '14 Hari']);
        Payment::create(['name' => '21 Hari']);
        Payment::create(['name' => '28 Hari']);
        Payment::create(['name' => '30 Hari']);
        Payment::create(['name' => '60 Hari']);
        Payment::create(['name' => '90 Hari']);
    }
}
