<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // RO Item Types
        DB::table('ro_item_types')->insert([
            ['id' => 0, 'name' => 'healing_item', 'display_name' => 'Healing item'],
            ['id' => 2, 'name' => 'usable_item', 'display_name' => 'Usable item'],
            ['id' => 3, 'name' => 'etc', 'display_name' => 'Etc'],
            ['id' => 4, 'name' => 'weapon', 'display_name' => 'Weapon'],
            ['id' => 5, 'name' => 'armor', 'display_name' => 'Armor'],
            ['id' => 6, 'name' => 'card', 'display_name' => 'Card'],
            ['id' => 7, 'name' => 'pet_egg', 'display_name' => 'Pet egg'],
            ['id' => 8, 'name' => 'pet_equipment', 'display_name' => 'Pet equipment'],
            ['id' => 10, 'name' => 'ammo', 'display_name' => 'Ammo'],
            ['id' => 11, 'name' => 'delayed_usable', 'display_name' => 'Usable with delayed consumption'],
            ['id' => 18, 'name' => 'delayed_usable_confirm', 'display_name' => 'Delayed consume that requires user confirmation before using item']
        ]);

        $healingItemType = App\RoItemType::first();
        $healingItemType->id = 0;
        $healingItemType->save();

        // Servers
        DB::table('servers')->insert([
         //    ['name' => 'loki'],
         //    ['name' => 'thor'],
            // ['name' => 'chaos'],
        	['name' => 'valkyrie'],
        ]);

        // Stalls
        // DB::table('stalls')->insert([
        //     'name' => 'S>pots',
        //     'user_id' => 1,
        //     'server_id' => 1
        // ]);

        $this->call(RoItemsSeeder::class);
        $this->call(MoreRoItemsSeeder::class);
    }
}
