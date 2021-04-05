<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorsSeeder extends Seeder
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
            DB::table('sectors')->insert([
                'id' => $i,
                'title' => 'Sector' . $i,
                'parent_id' => rand(NULL, 12),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }

    }
}
