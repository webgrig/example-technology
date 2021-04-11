<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSectoryablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inserting usersectoryables data
        DB::table('usersectoryables')->insert([
            ['sector_id' => 1, 'usersectoryables_id' => 3, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 8, 'usersectoryables_id' => 3, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 11, 'usersectoryables_id' => 3, 'usersectoryables_type' => 'App\\Models\\User'],
        ]);
    }
}
