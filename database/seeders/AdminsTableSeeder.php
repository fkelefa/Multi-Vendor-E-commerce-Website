<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            /* [
                'id' => 1, 'name' => 'Super Admin', 'type' => 'superadmin', 'vendor_id' => 0, 'mobile' => '07775050888',
                'email' => 'admin@admin.com', 'password' => '$2a$12$vvfsq9DVabVpANdTlVChweF.TMo4/iN4.XftY7jvCg9g/gAvhmp/u', 'image' => '', 'status' => 1,
            ], */

            [
                'id' => 2, 'name' => 'John', 'type' => 'vendor', 'vendor_id' => 1, 'mobile' => '0123456789',
                'email' => 'john@admin.com', 'password' => '$2a$12$vvfsq9DVabVpANdTlVChweF.TMo4/iN4.XftY7jvCg9g/gAvhmp/u', 'image' => '', 'status' => 0,
            ],
        ];
        Admin::insert($adminRecords);
    }
}
