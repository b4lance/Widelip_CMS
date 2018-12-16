<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Confirmación de tu cuenta</title>
	<link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.css')}}">
</head>
<body>
	<h1 class="text-center">Bienvenido a la Plataforma Widelip</h1>
	<p>Para confirmar tu cuenta presiona el siguiente enlace</p>
	<a href="{{route('register_confirmed',$user->id)}}">Confirmar cuenta</a>
</body>
</html>