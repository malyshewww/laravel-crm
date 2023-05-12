<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{csrf_token()}}">
	<title>Document</title>
</head>
<body>
	<h1>Вход</h1>
	<form action="{{route('user.login')}}" method="post">
		@csrf
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" id="email" name="email" placeholder="Email">
			@error('email')
				<div class="alert">{{$message}}</div>
			@enderror
		</div>
		<div class="form-group">
			<label for="password">Пароль</label>
			<input type="password" id="password" name="password" placeholder="Password">
			@error('password')
				<div class="alert">{{$message}}</div>
			@enderror
		</div>
		<div class="form-group">
			<button type="submit" name="sendMe">Войти</button>
		</div>
	</form>
</body>
</html>