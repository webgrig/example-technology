<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;

class SectorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parentIDs = [2, NULL, 2, NULL, 4, 4, 4, NULL, 8, 8, 4, 11];
        foreach($parentIDs as $parentID){
            Sector::factory()
                ->create([
                    'parent_id' => $parentID,
                ]);
        }
    }
}
