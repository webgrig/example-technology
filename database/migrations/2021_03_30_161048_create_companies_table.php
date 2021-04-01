<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('phone');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });

        // Inserting companies data
        DB::table('companies')->insert([
            ['id' => 1, 'title' => 'First company', 'phone' => '1111111', 'email' => 'test1@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 2, 'title' => 'Second company', 'phone' => '2222222', 'email' => 'test2@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 3, 'title' => 'Third company', 'phone' => '3333333', 'email' => 'test3@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 4, 'title' => 'Fourth company', 'phone' => '44444444', 'email' => 'test4@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 5, 'title' => 'Fifth company', 'phone' => '5555555', 'email' => 'test5@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 6, 'title' => 'Sixth company', 'phone' => '6666666', 'email' => 'test6@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 7, 'title' => 'Seventh company', 'phone' => '7777777', 'email' => 'test7@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 8, 'title' => 'Eighth company', 'phone' => '8888888', 'email' => 'test8@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 9, 'title' => 'Ninth company', 'phone' => '9999999', 'email' => 'test9@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 10, 'title' => 'Tenth company', 'phone' => '10101010', 'email' => 'test10@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 11, 'title' => 'Eleventh company', 'phone' => '01101101', 'email' => 'test11@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 12, 'title' => 'Twelfth company', 'phone' => '01201201', 'email' => 'test12@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
