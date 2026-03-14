<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define all permissions needed
        $allPermissions = [
            // Brand
            'ViewAny:Brand', 'View:Brand', 'Create:Brand', 'Update:Brand', 'Delete:Brand',
            // Category
            'ViewAny:Category', 'View:Category', 'Create:Category', 'Update:Category', 'Delete:Category',
            // Product
            'ViewAny:Product', 'View:Product', 'Create:Product', 'Update:Product', 'Delete:Product',
            // Order
            'ViewAny:Order', 'View:Order', 'Create:Order', 'Update:Order', 'Delete:Order',
            // Customer
            'ViewAny:Customer', 'View:Customer', 'Create:Customer', 'Update:Customer', 'Delete:Customer',
            // Area
            'ViewAny:Area', 'View:Area', 'Create:Area', 'Update:Area', 'Delete:Area',
            // District
            'ViewAny:District', 'View:District', 'Create:District', 'Update:District', 'Delete:District',
            // Division
            'ViewAny:Division', 'View:Division', 'Create:Division', 'Update:Division', 'Delete:Division',
            // User
            'ViewAny:User', 'View:User', 'Create:User', 'Update:User', 'Delete:User',
            // Role
            'ViewAny:Role', 'View:Role', 'Create:Role', 'Update:Role', 'Delete:Role',
            // Setting
            'ViewAny:Setting', 'View:Setting', 'Update:Setting',
            // Widgets
            'View:OrderOverview', 'View:OrderChart', 'View:LatestOrders', 'View:BestSellingProductChart',
        ];

        // Create all permissions in the database
        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // Reset cached permissions after creating them
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $superAdmin = Role::updateOrCreate(
            ['name' => 'super_admin', 'guard_name' => 'web']
        );

        $manager = Role::updateOrCreate(
            ['name' => 'manager', 'guard_name' => 'web']
        );

        $panelUser = Role::updateOrCreate(
            ['name' => 'panel_user', 'guard_name' => 'web']
        );

        // Super Admin gets ALL permissions
        $superAdmin->syncPermissions(Permission::all());

        // Manager gets product, order, brand, category, customer, and view-only access to other resources
        $managerPermissions = [
            // Brand
            'ViewAny:Brand', 'View:Brand', 'Create:Brand', 'Update:Brand', 'Delete:Brand',
            // Category
            'ViewAny:Category', 'View:Category', 'Create:Category', 'Update:Category', 'Delete:Category',
            // Product
            'ViewAny:Product', 'View:Product', 'Create:Product', 'Update:Product', 'Delete:Product',
            // Order
            'ViewAny:Order', 'View:Order', 'Create:Order', 'Update:Order', 'Delete:Order',
            // Customer
            'ViewAny:Customer', 'View:Customer', 'Create:Customer', 'Update:Customer', 'Delete:Customer',
            // Area, District, Division (view & manage)
            'ViewAny:Area', 'View:Area', 'Create:Area', 'Update:Area', 'Delete:Area',
            'ViewAny:District', 'View:District', 'Create:District', 'Update:District', 'Delete:District',
            'ViewAny:Division', 'View:Division', 'Create:Division', 'Update:Division', 'Delete:Division',
            // Widgets (view)
            'View:OrderOverview', 'View:OrderChart', 'View:LatestOrders', 'View:BestSellingProductChart',
        ];
        $manager->syncPermissions($managerPermissions);

        // Panel User gets basic view-only permissions
        $panelUserPermissions = [
            'ViewAny:Brand', 'View:Brand',
            'ViewAny:Category', 'View:Category',
            'ViewAny:Product', 'View:Product',
            'ViewAny:Order', 'View:Order',
            'ViewAny:Customer', 'View:Customer',
            'ViewAny:Area', 'View:Area',
            'ViewAny:District', 'View:District',
            'ViewAny:Division', 'View:Division',
            // Widgets (view)
            'View:OrderOverview', 'View:OrderChart', 'View:LatestOrders', 'View:BestSellingProductChart',
        ];
        $panelUser->syncPermissions($panelUserPermissions);
    }
}
