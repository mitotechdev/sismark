<?php

namespace Database\Seeders;

use App\Models\Finance\Tax;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tax::create([ 
            'name' => 'PPN 10%',
            'tax_value' => 0.10,
        ]);

        Tax::create([ 
            'name' => 'PPN 11%',
            'tax_value' => 0.11,
        ]);

        Tax::create([ 
            'name' => 'PPN 12%',
            'tax_value' => 0.12,
        ]);
    }
}
