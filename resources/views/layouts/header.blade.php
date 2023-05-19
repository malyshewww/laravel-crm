<header class="header" id="header">
	<div class="container">
		<div class="header__menu menu-header">
			<div class="menu-header__options"> 
			<div class="menu-header__name">
				@if (Auth::check())
					<div class="text-primary">
						@if (Auth::user()->email == 'test@mail.ru')
							Алексей
						@elseif (Auth::user()->email == 'tch.sezona@yandex.ru')
							Канатова И.
						@elseif (Auth::user()->email == 'info@4sezonatravel.ru')
							Тихановская И.
						@endif
					</div>
				@endif
			</div>
			<div class="header__actions">
				<form action="{{route('user.logout')}}" id="formLogout">
					@csrf
					<button type="submit">Выйти</button>
				</form>
			</div>
		</div>
	</div>
</header>