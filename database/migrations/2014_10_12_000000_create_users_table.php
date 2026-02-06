<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('guardian_name')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('whatsapp_no')->nullable();
            $table->string('email',100)->unique();
            $table->string('address')->nullable();
            $table->string('insti_details')->nullable();
            $table->string('password');
            $table->string('role');// the role column
            $table->integer('institution_id')->unsigned()->nullable();
            $table->integer('course_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();
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
