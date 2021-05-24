@extends('layouts.layout')

@section('title', $task->title . ' - GreatJob')

@section('content')
<section>
	<div class = "container">
		<span class = "title">Запропонувати свої послуги</span>
		<form method = "POST" action = "/task/{{ $task->id }}/propose" class = "custom__form w75">
			@csrf
			<div>
				<label>Завдання: <a href="/task/{{ $task->id }}">{{ $task->title }}</a></label>
			</div>
			<div>
				<label>Повідомлення</label>
				<textarea name = "message" placeholder="Введіть дані для зв'язку з вами або свої пропозиції. Або залишіть пустим"></textarea>
			</div>
			<div>
				<button>Відправити</button>
			</div>
		</form>
	</div>
</section>
@endsection