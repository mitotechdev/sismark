<?php

namespace Database\Seeders;

use App\Models\Status\MarketProgress;
use Illuminate\Database\Seeder;

class MarketProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MarketProgress::create([
            'name' => 'Draf',
            'tag_front_end' => 'warning',
            'tag_status' => 'draf',
        ]);
        MarketProgress::create([
            'name' => 'Mapping',
            'tag_front_end' => 'primary',
            'tag_status' => 'map',
        ]);
        MarketProgress::create([
            'name' => 'Introduction',
            'tag_front_end' => 'primary',
            'tag_status' => 'int',
        ]);
        MarketProgress::create([
            'name' => 'Penetration',
            'tag_front_end' => 'primary',
            'tag_status' => 'pen',
        ]);
        MarketProgress::create([
            'name' => 'Jartest',
            'tag_front_end' => 'primary',
            'tag_status' => 'jar',
        ]);
        MarketProgress::create([
            'name' => 'Quotation',
            'tag_front_end' => 'primary',
            'tag_status' => 'quo',
        ]);
        MarketProgress::create([
            'name' => 'Negotiation',
            'tag_front_end' => 'primary',
            'tag_status' => 'neg',
        ]);
        MarketProgress::create([
            'name' => 'Deal',
            'tag_front_end' => 'success',
            'tag_status' => 'dea',
        ]);
        MarketProgress::create([
            'name' => 'Purchase Order',
            'tag_front_end' => 'success',
            'tag_status' => 'pur',
        ]);
        MarketProgress::create([
            'name' => 'Supply & Maintenance',
            'tag_front_end' => 'info',
            'tag_status' => 'sup',
        ]);
    }
}
