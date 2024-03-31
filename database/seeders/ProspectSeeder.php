<?php

namespace Database\Seeders;

use App\Models\Status\Prospect;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProspectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prospect::create([
            'name' => 'Draf',
            'tag_front_end' => 'warning',
            'tag_status' => 'draf',
        ]);
        Prospect::create([
            'name' => 'Prospecting',
            'tag_front_end' => 'primary',
            'tag_status' => 'prospect',
        ]);
        Prospect::create([
            'name' => 'Hot Prospect',
            'tag_front_end' => 'success',
            'tag_status' => 'hot',
        ]);
        Prospect::create([
            'name' => 'Loss Prospect',
            'tag_front_end' => 'danger',
            'tag_status' => 'loss',
        ]);
        Prospect::create([
            'name' => 'Void Prospect',
            'tag_front_end' => 'secondary',
            'tag_status' => 'void',
        ]);
    }
}
