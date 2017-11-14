@extends('static-layout')

@section('title', 'FAQ')

@section('static-content')
<div id="faq">
	<h3>What is Ragna Market?</h3>
	<p>Ragna Market is a virtual marketplace for <a href="http://ragnarokonline.com.ph">Ragnarok Online Philippines (EXE)</a> where you can set up a stall to sell your in-game items, or search for items you're looking to buy.</p>

	<p>The goal is to make a centralized one-stop shop marketplace for players to make it easier to sell or find items, similar to iRO's <a href="http://ragi.al/">Ragi.al market</a>, or the @autotrade and @whosells commands on private servers!</p>

	<h3>How do I start selling items?</h3>
	<ol>
		<li><a href="/register">Create an account</a></li>
		<li>Select your server on the navbar menu</li>
		<li>Click on <a href="/my-stall">My Stall</a> and start adding items.</li>
		<li>Enter the quantity, price (optional) and refine level/cards (if applicable) of your items. You may edit these later.</li>
		<li>Click save and wait for other players to contact you!</li>
	</ol>

	<p>You may also want to go to <a href="/user/edit">Profile > Edit</a> to add more IGNs, your contact info, or your playing schedule so other players can contact you easier.</p>

	<h3>How do I search or buy items?</h3>
	<ol>
		<li>Search for items you want to buy using the search bar or on the <a href="/search">Search page</a>. You can search for the item name, item ID, or keywords like "card" or "wand".</li>
		<li>Then click on the stall owner's name under the "Stall" column to go to the stall page.</li>
		<li>Contact the vendor through the provided contact info on the right sidebar.</li>
	</ol>

	<h3>How many stalls can I create?</h3>
	<p>You can only have one stall per server.</p>

	<h3>How many items can I put up on my stall?</h3>
	<p>As many as you want!</p>

	<h3>I found a bug / An item is missing / I have suggestions for the website</h3>
	<p>Please let us know through our <a href="https://www.facebook.com/ragna-marketcom-184012118837081/" target="_blank">Facebook page</a> or send us an e-mail at <a href="mailto:ragnamarketcom@gmail.com">ragnamarketcom@gmail.com</a>. Thank you!</p>


</div>

@endsection