<header>
	<nav>
		<ul>
		    @if (Auth::check())
		    <li><a href="{{ route('logout') }}">logout</a></li>
		    <li><a href="{{ route('users.show', Auth::user()->name) }}">profile</a></li>
		    @else
		    <li><a href="{{ route('login') }}">login</a></li>
		    @endif
		    <li><a href="{{ route('stalls.create') }}">create a stall</a></li>
		</ul>
	</nav>

	<h1><a href="{{ route('index') }}">roph-market.com</a></h1>
</header>