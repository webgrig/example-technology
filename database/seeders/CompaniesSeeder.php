<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Inserting sectors data
        for ($i = 1; $i <= 12; $i++) {
            DB::table('companies')->insert([
                'id' => $i,
                'title' => 'Company' . $i,
                'phone' => rand(1, 10000000),
                'email' => 'test' . $i. '@gmail.com',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
