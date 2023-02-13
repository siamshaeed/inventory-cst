<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use App\Models\Purchase;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(AdminUserSeeder::class);

        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RoleHasPermissionSeeder::class,
            ModelHasRoleSeeder::class,

            // Address Location
            DivisionSeeder::class,
            DistrictSeeder::class,
            UpazilaSeeder::class,
            UnionSeeder::class,
            AddressSeeder::class,

            AdminUserSeeder::class,
            //UserSeeder::class,

            CategorySeeder::class,
            BrandSeeder::class,
            GoodSeeder::class,
            WarehouseSeeder::class,
            MarketTypeSeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class,
            //StockSeeder::class,

            // Purchase
            PurchaseSeeder::class,
            PurchaseDueSeeder::class,
            PurchaseItemSeeder::class,

            // Expense
            ExpenseSeeder::class,

            // Order
            OrderSeeder::class,
            OrderItemSeeder::class,

            // Sale
            SaleSeeder::class,
            SaleItemSeeder::class,
            SalePaymentSeeder::class,

            WorkshopSeeder::class,
        ]);

    }
}
