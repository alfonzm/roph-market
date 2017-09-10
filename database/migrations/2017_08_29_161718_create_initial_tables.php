<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('stalls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('server_id')->unsigned();
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade');

            $table->text('description')->nullable();
            $table->timestamps();
        });

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
            $table->foreign('stall_id')->references('id')->on('stalls')->onDelete('cascade');

            $table->integer('ro_item_id')->unsigned();
            $table->foreign('ro_item_id')->references('id')->on('ro_items')->onDelete('cascade');

            $table->integer('price')->nullable();
            $table->integer('quantity')->default(1);

            $table->timestamps();
        });
        
        Schema::create('user_igns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ign');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('server_id')->unsigned();
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade');

            $table->timestamps();
        });
        
        Schema::create('user_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('value');

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
        Schema::dropIfExists('user_contacts');
        Schema::dropIfExists('user_igns');
        Schema::dropIfExists('stall_items');
        Schema::dropIfExists('ro_items');
        Schema::dropIfExists('ro_item_types');
        Schema::dropIfExists('stalls');
        Schema::dropIfExists('servers');
    }
}
