<header class="header" id="header">
	<div class="container">
		<div class="header__menu menu-header">
			<div class="menu-header__options"> 
			<div class="menu-header__name">
				@if (Auth::check())
					{{ Auth::user()->email }} 
				@endif
			</div>
			<a href="{{route('user.logout')}}">Выйти</a>
		</div>
	</div>
</header>