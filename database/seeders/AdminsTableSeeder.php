<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

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
            ['id'=>1, 'name'=>'Super Admin', 'type'=>'superadmin', 'vendor_id'=>0, 'mobile'=>'69856956895','email'=>'admin@admin.com','password'=>'$2a$12$1FEE4nKdecKJ/COND2xFkOvHcxtJzXO88Msy7RdgKc7ZcORZAscvK', 'image'=>'', 'status'=>1],
            
        ];
        Admin::insert($adminRecords);
    }
}
