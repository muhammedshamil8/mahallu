<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('family_id');
            $table->string('name')->nullable();
            $table->unsignedInteger('relation_id');
            $table->string('father_name')->nullable();
            $table->string('dob')->nullable();
            $table->string('mobile')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('id_card_no')->nullable();
            $table->string('aadhar_card_no')->nullable();
            $table->string('education')->nullable();
            $table->string('islamic_education')->nullable();
            $table->unsignedInteger('is_finding_job')->default(0);
            $table->unsignedInteger('is_looking_marriage')->default(0);
            $table->unsignedInteger('is_name_in_voter_list')->default(0);
            $table->string('job')->nullable();
            $table->string('job_place')->nullable();
            $table->string('income')->nullable();
            $table->unsignedInteger('marital_status_id')->nullable();
            $table->unsignedInteger('physical_status_id')->nullable();
            $table->string('number_of_child')->nullable();
            $table->string('profile_photo')->default('no_photo.png');
            $table->string('vehicles')->nullable();
            $table->string('health_info')->nullable();
            $table->string('gov_help_info')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
