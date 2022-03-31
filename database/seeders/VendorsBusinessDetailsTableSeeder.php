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
            ['id'=>1,'vendor_id'=>1,'shop_name'=>'John Electronics Store','shop_address'=>'1234_SCF','shop_city'=>'New Delhi','shop_state'=>'Delhi','shop_country'=>'India','shop_pincode'=>'110001','shop_mobile'=>'970000000','shop_website'=>'sitemakers.in','shop_email'=>'john@admin.com','address_proof'=>'Passport','address_proof_image'=>'test.jpg','business_license_number'=>'122313241','gst_number'=>'13133131','pan_number'=>'425252']
        ];

        VendorsBusinessDetail::insert($vendorRecords);
    }
}
