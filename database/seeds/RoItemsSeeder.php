<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Flynsarmy\CsvSeeder\CsvSeeder;

class RoItemsSeeder extends CsvSeeder
{
    public function __construct() {
        $this->table = 'ro_items';
        $this->filename = base_path().'/database/seeds/ro_items.csv';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // RO Items
        DB::disableQueryLog();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table($this->table)->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        parent::run();
    }
}
