<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Product
        Permission::create(['name' => 'create-product', 'for' => 'Product', 'tag' => 'Create']);
        Permission::create(['name' => 'edit-product', 'for' => 'Product', 'tag' => 'Edit']);
        Permission::create(['name' => 'read-product', 'for' => 'Product', 'tag' => 'Read']);
        Permission::create(['name' => 'delete-product', 'for' => 'Product', 'tag' => 'Delete']);
        Permission::create(['name' => 'print-product', 'for' => 'Product', 'tag' => 'Print']);
        Permission::create(['name' => 'view-product', 'for' => 'Product', 'tag' => 'View']);
        //Project
        Permission::create(['name' => 'create-project', 'for' => 'Project', 'tag' => 'Create']);
        Permission::create(['name' => 'edit-project', 'for' => 'Project', 'tag' => 'Edit']);
        Permission::create(['name' => 'read-project', 'for' => 'Project', 'tag' => 'Read']);
        Permission::create(['name' => 'delete-project', 'for' => 'Project', 'tag' => 'Delete']);
        Permission::create(['name' => 'view-project', 'for' => 'Project', 'tag' => 'View']);
        // Task
        Permission::create(['name' => 'create-task', 'for' => 'Task', 'tag' => 'Create']);
        Permission::create(['name' => 'edit-task', 'for' => 'Task', 'tag' => 'Edit']);
        Permission::create(['name' => 'read-task', 'for' => 'Task', 'tag' => 'Read']);
        Permission::create(['name' => 'delete-task', 'for' => 'Task', 'tag' => 'Delete']);
        Permission::create(['name' => 'view-task', 'for' => 'Task', 'tag' => 'View']);
        // Customer
        Permission::create(['name' => 'create-customer', 'for' => 'Customer', 'tag' => 'Create']);
        Permission::create(['name' => 'edit-customer', 'for' => 'Customer', 'tag' => 'Edit']);
        Permission::create(['name' => 'read-customer', 'for' => 'Customer', 'tag' => 'Read']);
        Permission::create(['name' => 'delete-customer', 'for' => 'Customer', 'tag' => 'Delete']);
        Permission::create(['name' => 'view-customer', 'for' => 'Customer', 'tag' => 'View']);
        // Personalia
        Permission::create(['name' => 'create-personalia', 'for' => 'Personalia', 'tag' => 'Create']);
        Permission::create(['name' => 'edit-personalia', 'for' => 'Personalia', 'tag' => 'Edit']);
        Permission::create(['name' => 'read-personalia', 'for' => 'Personalia', 'tag' => 'Read']);
        Permission::create(['name' => 'delete-personalia', 'for' => 'Personalia', 'tag' => 'Delete']);
        Permission::create(['name' => 'view-personalia', 'for' => 'Personalia', 'tag' => 'View']);
        // Branch Customer
        Permission::create(['name' => 'create-brancher-customer', 'for' => 'Branch Customer', 'tag' => 'Create']);
        Permission::create(['name' => 'edit-brancher-customer', 'for' => 'Branch Customer', 'tag' => 'Edit']);
        Permission::create(['name' => 'read-brancher-customer', 'for' => 'Branch Customer', 'tag' => 'Read']);
        Permission::create(['name' => 'delete-brancher-customer', 'for' => 'Branch Customer', 'tag' => 'Delete']);
        Permission::create(['name' => 'view-brancher-customer', 'for' => 'Branch Customer', 'tag' => 'View']);
        // Quotation
        Permission::create(['name' => 'create-quotation', 'for' => 'Quotation', 'tag' => 'Create']);
        Permission::create(['name' => 'edit-quotation', 'for' => 'Quotation', 'tag' => 'Edit']);
        Permission::create(['name' => 'read-quotation', 'for' => 'Quotation', 'tag' => 'Read']);
        Permission::create(['name' => 'delete-quotation', 'for' => 'Quotation', 'tag' => 'Delete']);
        Permission::create(['name' => 'print-quotation', 'for' => 'Quotation', 'tag' => 'Print']);
        Permission::create(['name' => 'approve-quotation', 'for' => 'Quotation', 'tag' => 'Approve']);
        Permission::create(['name' => 'view-quotation', 'for' => 'Quotation', 'tag' => 'View']);
        // Quotation Item
        Permission::create(['name' => 'create-quotation-item', 'for' => 'Quotation Item', 'tag' => 'Create']);
        Permission::create(['name' => 'edit-quotation-item', 'for' => 'Quotation Item', 'tag' => 'Edit']);
        Permission::create(['name' => 'read-quotation-item', 'for' => 'Quotation Item', 'tag' => 'Read']);
        Permission::create(['name' => 'delete-quotation-item', 'for' => 'Quotation Item', 'tag' => 'Delete']);
        Permission::create(['name' => 'submit-quotation-item', 'for' => 'Quotation Item', 'tag' => 'Submit Item']);
        Permission::create(['name' => 'view-quotation-item', 'for' => 'Quotation Item', 'tag' => 'View']);
        // Sales Order
        Permission::create(['name' => 'create-sales-order', 'for' => 'Sales Order', 'tag' => 'Create']);
        Permission::create(['name' => 'edit-sales-order', 'for' => 'Sales Order', 'tag' => 'Edit']);
        Permission::create(['name' => 'read-sales-order', 'for' => 'Sales Order', 'tag' => 'Read']);
        Permission::create(['name' => 'delete-sales-order', 'for' => 'Sales Order', 'tag' => 'Delete']);
        Permission::create(['name' => 'print-sales-order', 'for' => 'Sales Order', 'tag' => 'Print']);
        Permission::create(['name' => 'approve-sales-order', 'for' => 'Sales Order', 'tag' => 'Approve']);
        Permission::create(['name' => 'view-sales-order', 'for' => 'Sales Order', 'tag' => 'View']);
        // Sales Order Item
        Permission::create(['name' => 'create-sales-order-item', 'for' => 'SO Item', 'tag' => 'Create']);
        Permission::create(['name' => 'edit-sales-order-item', 'for' => 'SO Item', 'tag' => 'Edit']);
        Permission::create(['name' => 'read-sales-order-item', 'for' => 'SO Item', 'tag' => 'Read']);
        Permission::create(['name' => 'delete-sales-order-item', 'for' => 'SO Item', 'tag' => 'Delete']);
        Permission::create(['name' => 'submit-sales-order-item', 'for' => 'SO Item', 'tag' => 'Submit Item']);
        Permission::create(['name' => 'view-sales-order-item', 'for' => 'SO Item', 'tag' => 'View']);
        // Loss Prospect
        Permission::create(['name' => 'create-loss-prospect', 'for' => 'Loss Prospect', 'tag' => 'Create']);
        Permission::create(['name' => 'read-loss-prospect', 'for' => 'Loss Prospect', 'tag' => 'Read']);
        Permission::create(['name' => 'view-loss-prospect', 'for' => 'Loss Prospect', 'tag' => 'View']);
        // Payments
        Permission::create(['name' => 'create-payments', 'for' => 'Payment', 'tag' => 'Create']);
        Permission::create(['name' => 'edit-payments', 'for' => 'Payment', 'tag' => 'Edit']);
        Permission::create(['name' => 'read-payments', 'for' => 'Payment', 'tag' => 'Read']);
        Permission::create(['name' => 'delete-payments', 'for' => 'Payment', 'tag' => 'Delete']);
        Permission::create(['name' => 'view-payments', 'for' => 'Payment', 'tag' => 'View']);
        // Bills
        Permission::create(['name' => 'view-bill', 'for' => 'Bill', 'tag' => 'View']);
        Permission::create(['name' => 'mark-paid-off', 'for' => 'Bill', 'tag' => 'Edit']);
        // User
        Permission::create(['name' => 'create-user', 'for' => 'User', 'tag' => 'Create']);
        Permission::create(['name' => 'edit-user', 'for' => 'User', 'tag' => 'Edit']);
        Permission::create(['name' => 'read-user', 'for' => 'User', 'tag' => 'Read']);
        Permission::create(['name' => 'delete-user', 'for' => 'User', 'tag' => 'Delete']);
        Permission::create(['name' => 'view-user', 'for' => 'User', 'tag' => 'View']);
        // Role
        Permission::create(['name' => 'create-role', 'for' => 'Role', 'tag' => 'Create']);
        Permission::create(['name' => 'edit-role', 'for' => 'Role', 'tag' => 'Edit']);
        Permission::create(['name' => 'read-role', 'for' => 'Role', 'tag' => 'Read']);
        Permission::create(['name' => 'delete-role', 'for' => 'Role', 'tag' => 'Delete']);
        Permission::create(['name' => 'view-role', 'for' => 'Role', 'tag' => 'View']);
        // Permission
        Permission::create(['name' => 'create-permission', 'for' => 'Permission', 'tag' => 'Create']);
        Permission::create(['name' => 'edit-permission', 'for' => 'Permission', 'tag' => 'Edit']);
        Permission::create(['name' => 'read-permission', 'for' => 'Permission', 'tag' => 'Read']);
        Permission::create(['name' => 'delete-permission', 'for' => 'Permission', 'tag' => 'Delete']);
        Permission::create(['name' => 'view-permission', 'for' => 'Permission', 'tag' => 'View']);
        // Assign User to Role
        Permission::create(['name' => 'assign-role', 'for' => 'Assign Role', 'tag' => 'Assign Role']);
        Permission::create(['name' => 'remove-role', 'for' => 'Assign Role', 'tag' => 'Remove Role']);
        // Branch
        Permission::create(['name' => 'create-branch', 'for' => 'Branch', 'tag' => 'Create']);
        Permission::create(['name' => 'edit-branch', 'for' => 'Branch', 'tag' => 'Edit']);
        Permission::create(['name' => 'read-branch', 'for' => 'Branch', 'tag' => 'Read']);
        Permission::create(['name' => 'view-branch', 'for' => 'Branch', 'tag' => 'View']);
        Permission::create(['name' => 'delete-branch', 'for' => 'Branch', 'tag' => 'Delete']);
        // Stats
        Permission::create(['name' => 'view-stats', 'for' => 'Additional Access', 'tag' => 'View Stats']);
        // Card
        Permission::create(['name' => 'view-cards', 'for' => 'Additional Access', 'tag' => 'View Cards']);
        // Team
        Permission::create(['name' => 'view-team', 'for' => 'Additional Access', 'tag' => 'View Teams']);
    }
}
