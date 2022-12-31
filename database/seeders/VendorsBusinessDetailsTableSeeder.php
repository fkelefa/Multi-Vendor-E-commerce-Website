<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBusinessDetail;

class VendorsBusinessDetailsTableSeeder extends Seeder
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
                'id' => 1, 'vendor_id' => 1, 'shop_name' => 'Jhon Electronics', 'shop_address' => '1234-CSF', 'shop_city' => 'New Delhi',
                'shop_state' => 'Delhi', 'shop_country' => 'Indea', 'shop_pincode' => '110001', 'shop_mobile' => '0123456789', 'shop_website' => 'sitemakers.in',
                'shop_email' => 'jhon@admin.com', 'address_proof' => 'passport', 'address_proof_image' => 'test.jpg', 'business_license_number' => '12365478',
                'gst_number' => '12345567', 'pan_number' => '12345567',
            ]
        ];

        VendorsBusinessDetail::insert($vendorRecords);
    }
}
