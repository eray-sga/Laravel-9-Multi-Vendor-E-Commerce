<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBankDetail;

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
            ['id'=>1,'vendor_id'=>1,'account_holder_name'=>'John Cena','bank_name'=>'ICICI','account_number'=>'13133143','bank_ifsc_code'=>'33311314']
        ];
        VendorsBankDetail::insert($vendorRecords);
    }
}
