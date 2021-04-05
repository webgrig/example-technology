<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usersectoryables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersectoryables', function (Blueprint $table) {
            $table->integer('sector_id')->nullable();
            $table->integer('usersectoryables_id');
            $table->text('usersectoryables_type');
        });

        // Inserting usersectoryables data
        DB::table('usersectoryables')->insert([
            ['sector_id' => 1, 'usersectoryables_id' => 1, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 2, 'usersectoryables_id' => 1, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 3, 'usersectoryables_id' => 1, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 4, 'usersectoryables_id' => 1, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 5, 'usersectoryables_id' => 1, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 6, 'usersectoryables_id' => 1, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 7, 'usersectoryables_id' => 1, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 8, 'usersectoryables_id' => 1, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 3, 'usersectoryables_id' => 2, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 4, 'usersectoryables_id' => 2, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 5, 'usersectoryables_id' => 2, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 6, 'usersectoryables_id' => 2, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 7, 'usersectoryables_id' => 2, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 8, 'usersectoryables_id' => 2, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 9, 'usersectoryables_id' => 2, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 10, 'usersectoryables_id' => 2, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 1, 'usersectoryables_id' => 3, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 8, 'usersectoryables_id' => 3, 'usersectoryables_type' => 'App\\Models\\User'],
            ['sector_id' => 11, 'usersectoryables_id' => 3, 'usersectoryables_type' => 'App\\Models\\User'],
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
