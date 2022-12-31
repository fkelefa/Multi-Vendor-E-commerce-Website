<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VendorsBankDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorsBankDetailsTableSeeder extends Seeder
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
                'id' => 1, 'vendor_id' => 1, 'account_holder_name' => 'Jhon Cena', 'bank_name' => 'ICICI',
                'account_number' => '01112547455', 'bank_ifsc_code' => '243353564',
            ]
        ];

        VendorsBankDetail::insert($vendorRecords);
    }
}
