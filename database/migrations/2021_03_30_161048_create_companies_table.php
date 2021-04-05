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
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });

        // Inserting companies data
        DB::table('companies')->insert([
            ['id' => 1, 'title' => 'Company1', 'phone' => '1111111', 'email' => 'test1@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 2, 'title' => 'Company2', 'phone' => '2222222', 'email' => 'test2@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 3, 'title' => 'Company3', 'phone' => '3333333', 'email' => 'test3@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 4, 'title' => 'Company4', 'phone' => '44444444', 'email' => 'test4@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 5, 'title' => 'Company5', 'phone' => '5555555', 'email' => 'test5@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 6, 'title' => 'Company6', 'phone' => '6666666', 'email' => 'test6@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 7, 'title' => 'Company7', 'phone' => '7777777', 'email' => 'test7@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 8, 'title' => 'Company8', 'phone' => '8888888', 'email' => 'test8@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 9, 'title' => 'Company9', 'phone' => '9999999', 'email' => 'test9@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 10, 'title' => 'Company10', 'phone' => '10101010', 'email' => 'test10@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 11, 'title' => 'Company11', 'phone' => '01101101', 'email' => 'test11@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['id' => 12, 'title' => 'Company12', 'phone' => '01201201', 'email' => 'test12@gmail.com', 'email_verified_at' => NULL, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]
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
