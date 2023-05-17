@extends('layouts.app')
@section('title')
	Вход
@endsection
@section('content')
	<section class="auth"> 
		<div class="auth__container"> 
			<div class="auth__body"> 
				<h1 class="auth__title">Вход</h1>
				<form class="auth__from form-auth" action="{{route('user.login')}}" method="post" id="formLogin">
					@csrf
					<div class="field-group">
						<div class="field-group__items"> 
							<div class="field-group__item">
								<label class="field-group__label" for="login">Логин</label>
								<input class="field-group__input" type="text" name="login" id="login" placeholder="Введите логин">
								@error('login')
									<div class="text-danger">{{$message}}</div>
								@enderror
							</div>
							<div class="field-group__item">
								<label class="field-group__label" for="login">E-mail</label>
								<input class="field-group__input" type="email" name="email" placeholder="Введите email">
								@error('email')
									<div class="text-danger">{{$message}}</div>
								@enderror
							</div>
							<div class="field-group__item">
								<label class="field-group__label" for="login">Пароль</label>
								<input class="field-group__input" type="password" name="password" placeholder="Введите пароль">
								@error('password')
									<div class="text-danger">{{$message}}</div>
								@enderror
							</div>
						</div>
						<button class="auth__button btn btn-primary" name="sendMe" type="submit">Войти</button>
					</div>
				</form>
				<div class="row justify-content-center mt-2">
					<a href="{{route('user.registration')}}" class="col text-center">Зарегистрироваться</a>
				</div>
			</div>
		</div>
	</section>
@endsection

