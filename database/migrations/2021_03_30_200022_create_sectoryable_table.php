<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectoryableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sectoryables', function (Blueprint $table) {
            $table->integer('sector_id')->nullable();
            $table->integer('sectoryables_id');
            $table->text('sectoryables_type');
        });

        // Inserting sectoryables data
        DB::table('sectoryables')->insert([
            ['sector_id' => 1, 'sectoryables_id' => 1, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 6, 'sectoryables_id' => 1, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => NULL, 'sectoryables_id' => 2, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 2, 'sectoryables_id' => 12, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 1, 'sectoryables_id' => 12, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 4, 'sectoryables_id' => 12, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 9, 'sectoryables_id' => 12, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => NULL, 'sectoryables_id' => 3, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 3, 'sectoryables_id' => 10, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 4, 'sectoryables_id' => 10, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 1, 'sectoryables_id' => 9, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 4, 'sectoryables_id' => 9, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 1, 'sectoryables_id' => 8, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 4, 'sectoryables_id' => 8, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 4, 'sectoryables_id' => 5, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 10, 'sectoryables_id' => 5, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 4, 'sectoryables_id' => 4, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 5, 'sectoryables_id' => 4, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 1, 'sectoryables_id' => 7, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 4, 'sectoryables_id' => 7, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 4, 'sectoryables_id' => 6, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 11, 'sectoryables_id' => 6, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 12, 'sectoryables_id' => 6, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 1, 'sectoryables_id' => 11, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 3, 'sectoryables_id' => 11, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 4, 'sectoryables_id' => 11, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 6, 'sectoryables_id' => 11, 'sectoryables_type' => 'App\\Models\\Company'],
            ['sector_id' => 9, 'sectoryables_id' => 11, 'sectoryables_type' => 'App\\Models\\Company']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sectoryables');
    }
}
