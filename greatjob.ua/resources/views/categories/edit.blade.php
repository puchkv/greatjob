@extends('layouts.layout')

@section('content')
<section>
	<span class="title">Редагування категорії</span>
	<form class = "custom__form" method = "POST" 
		action = "/categories/{{  $category->id }}">
		@method('PATCH')
		@csrf
		
		<div>
			<input type = "text" name = "name" value="{{ $category->name }}" />
		</div>
		<div>
			<button type = "submit" class = "green">
				Підтвердити зміну
			</button>
		</div>
	</form>
	<form class = "custom__form" method = "POST" 
		action = "/categories/{{ $category->id }}">
		@method('DELETE')
		@csrf
		<div>
			<button type = "submit" class = "red">Видалити</button>
		</div>
	</form>
</section>
@endsection