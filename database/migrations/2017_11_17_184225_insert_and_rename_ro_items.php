<?php

use App\RoItem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertAndRenameRoItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        RoItem::find(5801)->update(['name' => 'Ribbon of Bride']);
        RoItem::find(5358)->update(['name' => 'Pecopeco Ears']);
        RoItem::find(5213)->update(['name' => 'Black Bunny Band']);
        RoItem::find(5230)->update(['name' => 'White Dropping Cat']);
        RoItem::find(5428)->update(['name' => 'Bread Bag']);
        RoItem::find(5379)->update(['name' => 'Balloon Hat']);

        // missing:
        RoItem::create([
            'id' => 18571,
            'aegis_name' => 'Lucky_Hat',
            'name' => 'Lucky Hat',
            'type' => 5,
            'weight' => 100,
            'slots' => 0,
            'equip_jobs' => 4294967295,
            'equip_upper' => 7,
            'equip_genders' => 2,
            'equip_locations' => 256,
            'equip_level' => 0,
            'refineable' => false
        ]);
        RoItem::create([
            'id' => 16774,
            'aegis_name' => 'Asgard_Scroll',
            'name' => 'Asgard Scroll',
            'weight' => 1,
            'type' => 18,
            'equip_jobs' => 4294967295,
            'equip_upper' => 7,
            'equip_genders' => 2
        ]);
        RoItem::create([
            'id' => 18550,
            'aegis_name' => 'Asgard_Blessing',
            'name' => 'Asgard Blessing',
            'type' => 5,
            'weight' => 30,
            'slots' => 1,
            'equip_jobs' => 4294967295,
            'equip_upper' => 7,
            'equip_genders' => 2,
            'equip_locations' => 256,
            'equip_level' => 30,
        ]);
        RoItem::create([
            'id' => 16682,
            'aegis_name' => 'Boarding_Halter_Box7',
            'name' => 'Boarding Halter Box 7D',
            'type' => 18,
            'weight' => 1,
            'equip_jobs' => 4294967295,
            'equip_upper' => 7,
            'equip_genders' => 2
        ]);
        RoItem::create([
            'id' => 16683,
            'aegis_name' => 'Boarding_Halter_Box30',
            'name' => 'Boarding Halter Box 30D',
            'type' => 18,
            'weight' => 1,
            'equip_jobs' => 4294967295,
            'equip_upper' => 7,
            'equip_genders' => 2
        ]);

        // zaha doll 5464
        // 5789
        // 18642-18644
        // 18612 musang
        // 18613 musang
        // 5393 valentine hat
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        RoItem::destroy([18571, 16774, 18550, 16682, 16683]);
    }
}
