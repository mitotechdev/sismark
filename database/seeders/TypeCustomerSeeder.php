<?php

namespace Database\Seeders;

use App\Models\Status\TypeCustomer;
use Illuminate\Database\Seeder;

class TypeCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeCustomer::create(['name' => 'New Customer', 'tag_front_end' => 'primary', 'tag_status' => 'newcus']);
        TypeCustomer::create(['name' => 'Not yet Follow up', 'tag_front_end' => 'warning', 'tag_status' => 'notyet']);
        TypeCustomer::create(['name' => 'Done Follow up', 'tag_front_end' => 'info', 'tag_status' => 'done']);
        TypeCustomer::create(['name' => 'Existing', 'tag_front_end' => 'success', 'tag_status' => 'existing']);
    }
}
