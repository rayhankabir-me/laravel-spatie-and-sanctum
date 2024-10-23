<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run():void
    {
        $adminRole = Role::find(1);
        $adminRole?->givePermissionTo(Permission::all());

        $branchManager = Role::find(3);
        if ($branchManager) {
            $branchManagerPermissions = [
                ['name' => 'dashboard'],
                ['name' => 'dining-tables'],
                ['name' => 'pos'],
                ['name' => 'pos-orders'],
                ['name' => 'online-orders'],
                ['name' => 'table-orders'],
                ['name' => 'push-notifications'],
                ['name' => 'push-notifications_create'],
                ['name' => 'push-notifications_edit'],
                ['name' => 'push-notifications_delete'],
                ['name' => 'push-notifications_show'],
                ['name' => 'messages'],
                ['name' => 'delivery-boys'],
                ['name' => 'delivery-boys_create'],
                ['name' => 'delivery-boys_edit'],
                ['name' => 'delivery-boys_delete'],
                ['name' => 'delivery-boys_show'],
                ['name' => 'customers'],
                ['name' => 'customers_create'],
                ['name' => 'customers_edit'],
                ['name' => 'customers_delete'],
                ['name' => 'customers_show'],
                ['name' => 'employees'],
                ['name' => 'employees_create'],
                ['name' => 'employees_edit'],
                ['name' => 'employees_delete'],
                ['name' => 'employees_show'],
                ['name' => 'transactions'],
                ['name' => 'sales-report']
            ];
            $branchManagerPermissions = Permission::whereIn('name', $branchManagerPermissions)->get();
            $branchManager->givePermissionTo($branchManagerPermissions);
        }

        $posOperatorManager = Role::find(4);
        if ($posOperatorManager) {
            $posOperatorManagerPermissions = [
                ['name' => 'dashboard'],
                ['name' => 'pos'],
                ['name' => 'pos-orders']
            ];
            $posOperatorManagerPermissions = Permission::whereIn('name', $posOperatorManagerPermissions)->get();
            $posOperatorManager->givePermissionTo($posOperatorManagerPermissions);
        }
    }
}
