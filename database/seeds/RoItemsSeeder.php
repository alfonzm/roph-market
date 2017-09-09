<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RoItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // RO Items
        DB::table('ro_items')->insert([
            ['id' => 500, 'name' => 'Red Potion', 'ro_item_type_id' => 1],
            ['id' => 501, 'name' => 'Blue Potion', 'ro_item_type_id' => 1],
            ['id' => 700, 'name' => 'White Potion', 'ro_item_type_id' => 1]
        ]);
    }
}
