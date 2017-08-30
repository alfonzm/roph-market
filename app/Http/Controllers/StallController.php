<?php

namespace App\Http\Controllers;

use Auth;
use App\Stall;
use App\StallItem;
use App\Server;
use Illuminate\Http\Request;

class StallController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        return Stall::latest()->get();
    }

    public function create()
    {
        return view('stalls/create');
    }

    public function store(Request $request)
    {
        $stall = Stall::create([
            'name' => request('name'),
            'user_id' => Auth::id(),
            'server_id' => Server::first()->id,
        ]);

        $stallItems = [];
        $stallItemsRequest = request('stall_items');

        foreach($stallItemsRequest as $stallItem) {
            $stallItems[] = new StallItem($stallItem);
        }

        return $stall->stallItems()->saveMany($stallItems);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stall  $stall
     * @return \Illuminate\Http\Response
     */
    public function show(Stall $stall)
    {
        return view('stalls/show', [
            'stall' => $stall->load('stallItems.roItem')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stall  $stall
     * @return \Illuminate\Http\Response
     */
    public function edit(Stall $stall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stall  $stall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stall $stall)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stall  $stall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stall $stall)
    {
        $stall->delete();
        return 204;
    }
}
