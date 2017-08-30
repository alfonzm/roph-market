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
        // Test user
        DB::table('users')->insert([
            'name' => 'alphonsus',
            'email' => 'm.alfonz@gmail.com',
            'password' => bcrypt('qweqwe')
        ]);

        // RO Item Types
        DB::table('ro_item_types')->insert([
            'name' => 'consumable',
        ]);
        DB::table('ro_item_types')->insert([
            'name' => 'weapon',
        ]);
        DB::table('ro_item_types')->insert([
            'name' => 'card',
        ]);

        // RO Items
        DB::table('ro_items')->insert([
            'id' => 500,
            'name' => 'Red Potion',
            'ro_item_type_id' => 1
        ]);
        DB::table('ro_items')->insert([
            'id' => 501,
            'name' => 'Blue Potion',
            'ro_item_type_id' => 1
        ]);
        DB::table('ro_items')->insert([
            'id' => 700,
            'name' => 'White Potion',
            'ro_item_type_id' => 1
        ]);

        // Servers
        DB::table('servers')->insert([
        	'name' => 'thor'
    	]);
        DB::table('servers')->insert([
        	'name' => 'loki'
    	]);

        // Stalls
        DB::table('stalls')->insert([
            'name' => 'S>pots',
            'user_id' => 1,
            'server_id' => 1
        ]);
    }
}
