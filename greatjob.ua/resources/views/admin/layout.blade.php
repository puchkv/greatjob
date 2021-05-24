<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel = "stylesheet" href = "{{ URL::asset('css/admin.css') }}" />
    <title>Adminitration panel</title>
</head>
<body>
    <section class = "admin_panel">
        <article class = "admin_panel_left_sidebar" id = "menu">
            <ul>
                <li>
                    <a href = "#">Основне</a>
                </li>
                <li>
                    <a href = "#">Користувачі</a>
                </li>
                <li>
                    <a href="#">Завдання</a>
                </li>
                <li>
                    <a href="#">Категорії</a>
                </li>
                <li>
                    <a href="#">Звіти</a>
                </li>
            </ul>
                    
        </article>
                
        @yield('content')

    </section>
</body>
</html>
    