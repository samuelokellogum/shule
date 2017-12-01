<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('users');
    

        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id')->unassigned();
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->string('contact');
            $table->integer('userg')->unassigned();
            $table->date('dob');
            $table->string('image');
            $table->tinyInteger('status')->unassigned();
            $table->integer('audit');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
