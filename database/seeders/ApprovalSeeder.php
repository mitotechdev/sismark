<?php

namespace Database\Seeders;

use App\Models\Status\Approval;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApprovalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Approval::create([
            'name' => 'Draf',
            'tag_front_end' => 'warning',
            'tag_status' => 'draf',
        ]);

        Approval::create([
            'name' => 'Request',
            'tag_front_end' => 'info',
            'tag_status' => 'req',
        ]);

        Approval::create([
            'name' => 'Approved',
            'tag_front_end' => 'success',
            'tag_status' => 'approved',
        ]);

        Approval::create([
            'name' => 'Reject',
            'tag_front_end' => 'danger',
            'tag_status' => 'rej',
        ]);

        Approval::create([
            'name' => 'Closed',
            'tag_front_end' => 'success',
            'tag_status' => 'closed',
        ]);
    }
}
