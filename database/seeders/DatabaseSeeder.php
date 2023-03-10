<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            //AdminsTableSeeder::class,
            //VendorsTableSeeder::class,
            //VendorsBusinessDetailsTableSeeder::class,
            //VendorsBankDetailsTableSeeder::class,
            //SectionsTableSeeder::class,
            //CategoryTableSeeder::class,
            // BrandsTableSeeder::class,
            ProductsTableSeeder::class
        ]);
    }
}
