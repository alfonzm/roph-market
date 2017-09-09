<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStallItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ro_item_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('display_name');
        });

        Schema::create('ro_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('aegis_name');
            $table->string('name');
            $table->integer('type')->unsigned();
            $table->foreign('type')->references('id')->on('ro_item_types');
            $table->smallInteger('weight')->unsigned()->default(0);
            $table->tinyInteger('slots')->unsigned()->nullable();
            $table->integer('equip_jobs')->unsigned()->nullable();
            $table->tinyInteger('equip_upper')->unsigned()->nullable();
            $table->tinyInteger('equip_genders')->unsigned()->nullable();
            $table->smallInteger('equip_locations')->unsigned()->nullable();
            $table->tinyInteger('weapon_level')->unsigned()->nullable();
            $table->tinyInteger('equip_level')->unsigned()->nullable();
            $table->tinyInteger('refineable')->unsigned()->nullable();
            $table->smallInteger('view')->unsigned()->nullable();
        });
        
        Schema::create('stall_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stall_id')->unsigned();
            $table->foreign('stall_id')->references('id')->on('stalls');

            $table->integer('ro_item_id')->unsigned();
            $table->foreign('ro_item_id')->references('id')->on('ro_items');

            $table->integer('price')->nullable();
            $table->integer('quantity')->default(1);

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
        Schema::dropIfExists('stall_items');
        Schema::dropIfExists('ro_items');
        Schema::dropIfExists('ro_item_types');
    }
}
