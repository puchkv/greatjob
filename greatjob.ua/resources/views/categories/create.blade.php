@extends('layouts.layout')

@section('content')
<section>
	<span class="title">Додання нової категорії</span>
	<form class = "custom__form" method = "POST" action = "/categories">
		@csrf
		
		<div>
			<input type = "text" name = "name" placeholder="Назва категорії" required />
		</div>
		<div>
			<button type = "submit">Додати категорію</button>
		</div>
	</form>
</section>
@endsection