<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValkyrieServer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $valkyrie = App\Server::create(['name' => 'valkyrie']);

        App\User::where('id', '!=', null)->update(['server_id' => $valkyrie->id]);
        App\UserIgn::where('id', '!=', null)->update(['server_id' => $valkyrie->id]);

        $stalls = App\Stall::all();

        foreach($stalls as $stall) {
            $stall->timestamps = false;
            $stall->server_id = $valkyrie->id;
            $stall->save();
        }
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
