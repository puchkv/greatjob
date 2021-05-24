<header>
	<nav class = "navbar">
	<div class = "navbar__content">
		<div class = "navbar__content__brand"><a href = "/"></a></div>
		<input type = "checkbox" class = "navbar__control" id = "burger_control" />
		<ul class = "navbar__menu">
			<li><a href = "/task/create">Створити завдання</a></li>
			<li><a href = "/categories">Усі завдання</a></li>
			<li><a href = "/performers">Виконавці</a></li>
			@if(Auth::check())
				<li><a href = "/profile">Профіль</a></li>
				<li><a href="/logout" onclick="event.preventDefault(); 
				document.getElementById('logout_form').submit();">Вийти</a></li>
			@else
				<li><a href = "/login">Вхід</a></li>
				<li><a href = "/register">Реєстрація</a></li>
			@endif
		</ul>
		<div class = "navbar__sign">
			@if(Auth::check())
				<a href = "/profile" class = "navbar__sign__username">{{ Auth::user()->name }}</a></li>
				<a href = "/logout" onclick="event.preventDefault(); document.getElementById('logout_form').submit();">Вийти</a>
				<form id="logout_form" action="/logout" method="POST" style="display: none">
					@csrf
				</form>
			@else
				<a href = "/login">Увійти</a>
				<a href = "/register">Реєстрація</a>
			@endif
			
		</div>
		<label class = "navbar__indicator" for = "burger_control"><div></div></label>
		<!--<div id = "navbar__icon"><div></div></div>-->
	</div>
	</nav>
</header>