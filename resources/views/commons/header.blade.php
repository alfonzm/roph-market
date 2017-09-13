<header>
	<nav>
		<ul>
		    @if (Auth::check())
		    <li><a href="{{ route('logout') }}">Logout</a></li>
		    @else
		    <li><a href="{{ route('login') }}">Login</a></li>
		    @endif
		    <li><a href="{{ route('stalls.create') }}">Create a Stall</a></li>
		</ul>
	</nav>

	<h1><a href="{{ route('index') }}">roph-market.com</a></h1>
</header>