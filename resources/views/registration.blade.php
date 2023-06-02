@extends('layout.app')
@section('title')
	Регистрация
@endsection
@section('content')
	<section class="auth"> 
		<div class="auth__container"> 
			<div class="auth__body"> 
				<h1 class="auth__title">Регистрация</h1>
				<form class="auth__from form-auth" action="{{route('user.registration')}}" method="post" id="formRegistration">
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
						<button class="auth__button btn btn-primary" name="sendMe" type="submit">Зарегистрироваться</button>
					</div>
				</form>
			</div>
		</div>
	</section>
@endsection
@section('page-script')
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endsection