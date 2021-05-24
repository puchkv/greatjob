<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8" />	
	<meta name = "author" content = "Pchkv">
	<meta name = "viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0">
	@yield('token')
	<link rel = "stylesheet" href = "{{ URL::asset('css/main.css') }}" type = "text/css" />
	@yield('styles')
	<title>
		@yield('title', 'Great Job - Сервіс замовлення будівельних послуг')
	</title>
</head>
<body>
	@include('includes.header')
	
	@yield('content')

	@include('includes.footer')
	
	@yield('scripts')
</body>
</html>