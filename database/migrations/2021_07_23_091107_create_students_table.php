<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile_number');
            $table->string('whatsapp_number');
            $table->string('father_name');
            $table->string('father_mobile_number')->nullable();
            $table->string('father_whatsapp_number')->nullable();
            $table->string('mother_name');
            $table->string('mother_mobile_number')->nullable();
            $table->string('mother_whatsapp_number')->nullable();
            $table->date('dob');
            $table->enum('gender', array('male', 'female'));
            $table->integer('class_id')->unsigned();
            $table->float('fee')->nullable();
            $table->text('address')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('students');
    }
}
