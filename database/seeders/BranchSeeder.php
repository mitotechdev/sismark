<?php

namespace Database\Seeders;

use App\Models\Backend\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::create([
            'code' => 'PKU',
            'name' => 'HO Pekanbaru',
            'npwp' => '96.007.415.1-216.000',
            'phone' => '(0761) 5795004',
            'address' => 'Komp. Taman Harapan Indah, Blk. C No.16, Jl. Riau Gg. Harapan 2, Air Hitam, Kec. Payung Sekaki, Kota Pekanbaru, Riau 28292',
            'pic' => 'Tn. Taufan'
        ]);

        Branch::create([
            'code' => 'MDN',
            'name' => 'Branch & Warehouse Medan',
            'npwp' => '96.007.415.1-216.000',
            'phone' => '(061) 42776613',
            'address' => 'Komp. Menteng Indah Blok A4 No.5, Jl. Menteng VII, Medan Denai, Sumatera Utara',
            'pic' => 'Tn. M. Hafiz Lubis',
        ]);

        Branch::create([
            'code' => 'PNK',
            'name' => 'Branch & Warehouse Pontianak',
            'npwp' => '96.007.415.1-216.000',
            'phone' => 'Unavailable',
            'address' => 'Pergudangan Equator',
            'pic' => 'Tn. Saktiar Sitorus'
        ]);
    }
}
