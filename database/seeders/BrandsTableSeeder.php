<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecords = [
            ['id' => 1, 'name' => 'Arrow', 'status' => 1],
            ['id' => 2, 'name' => 'GAP', 'status' => 1],
            ['id' => 3, 'name' => 'LEE', 'status' => 1],
            ['id' => 4, 'name' => 'Samsung', 'status' => 1],
            ['id' => 5, 'name' => 'LG', 'status' => 1],
            ['id' => 6, 'name' => 'Lenovo', 'status' => 1],
            ['id' => 7, 'name' => 'MI', 'status' => 1],
        ];
        Brand::insert($brandRecords);
    }
}
