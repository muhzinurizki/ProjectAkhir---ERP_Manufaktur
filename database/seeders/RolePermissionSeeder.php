<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // Master
            'user.manage',
            'master.view',

            // Purchasing
            'purchase_request.create',
            'purchase_request.view',
            'purchase_request.approve',
            'purchase_order.create',
            'goods_receipt.create',

            // Inventory
            'inventory.view',
            'inventory.transfer',
            'inventory.approve_transfer',
            'inventory.stock_opname',

            // Production
            'work_order.create',
            'work_order.approve',
            'material_usage.create',
            'production_progress.create',

            // QC
            'qc.process',

            // Sales
            'quotation.create',
            'sales_order.approve',
            'delivery_order.create',
            'invoice.create',

            // Finance
            'ap.view',
            'ap.pay',
            'ar.view',
            'ar.receive',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $purchasing = Role::firstOrCreate(['name' => 'Purchasing']);
        $warehouse = Role::firstOrCreate(['name' => 'Warehouse']);
        $production = Role::firstOrCreate(['name' => 'Production']);
        $qc = Role::firstOrCreate(['name' => 'QC']);
        $sales = Role::firstOrCreate(['name' => 'Sales']);
        $finance = Role::firstOrCreate(['name' => 'Finance']);

        // Assign permissions
        $admin->givePermissionTo(Permission::all());

        $manager->givePermissionTo([
            'purchase_request.approve',
            'inventory.approve_transfer',
            'work_order.approve',
            'sales_order.approve',
        ]);

        $purchasing->givePermissionTo([
            'purchase_request.create',
            'purchase_request.view',
            'purchase_order.create',
        ]);

        $warehouse->givePermissionTo([
            'inventory.view',
            'inventory.transfer',
            'inventory.stock_opname',
            'goods_receipt.create',
        ]);

        $production->givePermissionTo([
            'work_order.create',
            'material_usage.create',
            'production_progress.create',
        ]);

        $qc->givePermissionTo([
            'qc.process',
        ]);

        $sales->givePermissionTo([
            'quotation.create',
            'delivery_order.create',
            'invoice.create',
        ]);

        $finance->givePermissionTo([
            'ap.view',
            'ap.pay',
            'ar.view',
            'ar.receive',
        ]);
    }
}
