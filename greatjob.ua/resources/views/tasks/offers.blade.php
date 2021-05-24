@extends('layouts.layout')

@section('title', $task->title . ' - GreatJob')

@section('content')
<section>
	<div class = "task__panel">
		<span class = "title">Пропозиції виконавців к завданню (№{{ $task->id }})</span>
		<a style = "margin-left: 20px" href = "/task/{{ $task->id }}">< Повернутись до завдання</a>
		@if($task->performer_id)
			<span class = "title">Обраний виконавець</span>
			<div class = "task__panel__row center">
				<div class = "performer_info">
					<div class = "profile__picture big">
						<img src = "/storage/pictures/{{ $task->performer->picture }}">
					</div>
					<a style = "font-size: 26px" href = "/user/{{ $task->performer->id }}">
						{{ $task->performer->name }}
					</a>
					<form  action = "/task/{{ $task->id }}/refuse" method="POST">
						@csrf
						<button class = "red">Відмовитись</button>
					</form>
				</div>
			</div>
		@endif
		@if($task->offers)
		<span class = "title">Усі пропозиції</span>
			@foreach($task->offers as $offer)
			<div class = "task__panel__row">
				<div class = "performer_info">
					<div class = "profile__picture">
						<img src = "/storage/pictures/{{ $offer->performer->picture }}">
					</div>
					<a href = "/user/{{ $offer->performer->id }}">
						{{ $offer->performer->name }}
					</a>
				</div>
				<div class = "arrow-left"></div>
				<div class = "offer_content">
					<div class = "left">
						<div>{{ $offer->message }}</div>
						<span>Надіслано: {{ $offer->created_at->isoFormat('Do MMMM YYYY в HH:mm') }}</span>
					</div>
					<div class= "right">
						@if($task->performer_id)
						@else
							<form action = "/task/{{ $task->id }}/accept/{{ $offer->performer->id }}" method = "POST">
								@csrf
								<button>Прийняти</button>
							</form>
						@endif
					</div>
				</div>
			</div>
			@endforeach
		@endif
	</div>
</section>
@endsection