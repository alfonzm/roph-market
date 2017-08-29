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
        DB::table('users')->insert([
            'name' => 'alphonsus',
            'email' => 'm.alfonz@gmail.com',
            'password' => bcrypt('qweqwe')
        ]);

        DB::table('servers')->insert([
        	'name' => 'thor'
    	]);
        DB::table('servers')->insert([
        	'name' => 'loki'
    	]);
    }
}
