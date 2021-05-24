@extends('layouts.layout')

@section('title',  'Виконавці - GreatJob')

@section('content')

<section>
	<div class = "performers">
		<div class = "performers__list">
			<span class = "title">Усі виконавці</span>
			@foreach($performers as $performer)
			<div class = "performer">
				<div class = "performer__tag">
					<span>{{ $performer->id }}</span>
				</div>

				<div class = "profile__picture">
					<img src = "/storage/pictures/{{ $performer->picture }}">
				</div>
				<div class = "performer__info">
					<span><a href = "/user/{{ $performer->id }}">
						{{ $performer->name }}
					</a></span>
					<span>Виконаних завдань: {{ $performer->getDoneWorks()->count() }}</span>
				</div>

				<div class = "performer__details">
					<div class = "progress p{{ round($performer->rating) }}  {{ $performer->getRatingColor() }}">
						<span>{{ round($performer->rating) }}%</span>
						<div class = "slice">
							<div class = "bar"></div>
							<div class = "fill"></div>
						</div>
					</div>
					<div class = "performer__rating">Рейтинг користувача</div>
				</div>
			</div>
		@endforeach
		</div>
	</div>
</section>

@endsection