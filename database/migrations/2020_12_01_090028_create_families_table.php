<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->string('head_of_family');
            $table->string('house_name')->nullable();
            $table->string('house_number')->nullable();
            $table->string('name_of_field')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('pin_number')->nullable();
            $table->string('ward_no')->nullable();
            $table->string('land_mark')->nullable();
            $table->string('post_no')->nullable();
            $table->string('type_of_house')->nullable();
            $table->string('well')->nullable();
            $table->string('water_connection')->nullable();
            $table->string('gas')->nullable();
            $table->string('area_of_land')->nullable();
            $table->string('place')->nullable();
            $table->string('district')->nullable();
            $table->string('relegion')->nullable();
            $table->string('ration_card')->nullable();
            $table->string('ration_card_no')->nullable();
            $table->string('house_ownership')->nullable();
            $table->string('house_owner_name')->nullable();
            $table->string('financial_status')->nullable();
            $table->string('vehicles')->default('No Vehicle');
            $table->string('favorite_masjid')->nullable();
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
        Schema::dropIfExists('families');
    }
}
