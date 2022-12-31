<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            [
                'id' => 1,
                'name' => 'John',
                'address' => 'CP-112',
                'city' => 'New Dilhi',
                'state' => 'Dilhi',
                'country' => 'India',
                'pincode' => '110001',
                'mobile' => '0123456789',
                'email' => 'john@admin.com',
                'status' => 0,

            ]
        ];
        Vendor::insert($vendorRecords);
    }
}
