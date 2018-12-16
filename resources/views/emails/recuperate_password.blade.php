<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Widelip</title>
</head>
<body>
	<h1 class="text-center">Bienvenido {{$user->name}}</h1>
	</p><br>
	Sigue el siguiente enlace para continuar con tu recuperación<br>	
	<a href="{{route('reset_data',$password)}}">Recuperar</a>
</body>
</html>