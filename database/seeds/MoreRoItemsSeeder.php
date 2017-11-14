<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Flynsarmy\CsvSeeder\CsvSeeder;

class MoreRoItemsSeeder extends CsvSeeder
{
    public function __construct() {
        $this->table = 'ro_items';
        $this->filename = base_path().'/database/seeds/ro_items2.csv';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        parent::run();
    }
}
