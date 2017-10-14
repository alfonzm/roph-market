<?php

namespace App\Http\Controllers;

use App\Server;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
    	$server = Server::find($_COOKIE['server'])->first();
        return view('home', compact('server'));
    }
}
