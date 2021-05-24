@extends('layouts.layout')

@section('title', $task->title . ' - GreatJob')

@section('content')
<section>
	<div class = "container">
		<span class = "title">Відгук про виконавця
			<a href = '/user/{{ $task->performer_id }}'>{{ $task->performer->name }}</a>
		</span>
		<form action = "/task/{{ $task->id }}/review" method = "POST" class = "custom__form w75">
			@csrf
			<div>
				<label>Завдання: <a href = '/task/{{ $task->id }}'>{{ $task->title }}</a></label>
			</div>
			<div>
				<label>Оцініть швидкість виконання завдання</label>
				<select name = "grade_speed" required>
					<option value = "5">Відмінно</option>
					<option value = "4">Гарно</option>
					<option value = "3">Задовільно</option>
					<option value = "2">Погано</option>
					<option value = "1">Жахливо</option>
				</select>
			</div>
			<div>
				<label>Оцініть коштовність виконання завдання</label>
				<select name = "grade_cost" required>
					<option value = "5">Відмінно</option>
					<option value = "4">Гарно</option>
					<option value = "3">Задовільно</option>
					<option value = "2">Погано</option>
					<option value = "1">Жахливо</option>
				</select>
			</div>
			<div>
				<label>Оцініть якість виконання завдання</label>
				<select name = "grade_quality" required>
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