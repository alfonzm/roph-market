<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertBlueSiegeBox extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App\RoItem::create([
            'id' => 12680,
            'aegis_name' => 'siege_blue_supply_box',
            'name' => 'Siege Blue Supply Box',
            'type' => 18,
            'weight' => 10,
            'equip_jobs' => 4294967295,
            'equip_upper' => 7,
            'equip_genders' => 2
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
