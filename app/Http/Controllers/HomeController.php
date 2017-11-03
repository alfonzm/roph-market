<?php

namespace App\Http\Controllers;

use App\Server;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
    	$serverId = isset($_COOKIE['server']) ? $_COOKIE['server'] : 0;
    	$server = Server::find($serverId);
    	
        return view('home', compact('server'));
    }
}
