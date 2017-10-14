<header>
	<nav>
		<ul>
		    @if (Auth::check())
		    <li><a href="{{ route('logout') }}">logout</a></li>
		    <li><a href="{{ route('users.show', Auth::user()->name) }}">profile</a></li>
		    @else
		    <li><a href="{{ route('login') }}">login</a></li>
		    @endif
		    <li><a href="{{ route('stalls.myStall') }}">my stall</a></li>
		    <li>
				<server-picker></server-picker>
		    </li>
		</ul>
	</nav>

	<h1>
		<a href="{{ route('index') }}">roph-market.com</a>
		<!-- <span class="subheader">A virtual marketplace for Ragnarok Online PH</span> -->
	</h1>
</header>