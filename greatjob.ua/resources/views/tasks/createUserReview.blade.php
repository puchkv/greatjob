@extends('layouts.layout')

@section('title', $task->title . ' - GreatJob')

@section('content')
<section>
	<div class = "container">
		<span class = "title">Відгук про замовника 
			<a href = '/user/{{ $task->user_id }}'>{{ $task->user->name }}</a>
		</span>
		<form action = "/task/{{ $task->id }}/review" method = "POST" class = "custom__form w75">
			@csrf
			<div>
				<label>Завдання: <a href = '/task/{{ $task->id }}'>{{ $task->title }}</a></label>
			</div>
			<div>
				<label>Оцініть роботу з замовником</label>
				<select name = "grade" required>
					<option value = "5">Відмінно</option>
					<option value = "4">Гарно</option>
					<option value = "3">Задовільно</option>
					<option value = "2">Погано</option>
					<option value = "1">Жахливо</option>
				</select>
			</div>
			<div>
				<label>Залишіть Ваші враження</label>
				<textarea name = "message" value = "{{ old('message') }}" required minlength="10"></textarea>
			</div>
			<div>
				<button>Залишити відгук</button>
			</div>
		</form>
	</div>
</section>
@endsection