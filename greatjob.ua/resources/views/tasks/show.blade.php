@extends('layouts.layout')

@section('title', $task->title . ' - GreatJob')

@section('content')
<section>
	<div class = "task__page">
		<div class = "task__page__header">
			<span class = "task__page__header__title">
				{{ $task->title }}
				<span>№{{ $task->id }}</span>
				<span style="display: block">{{ $task->getStatusName($task->status) }}</span>
				@if(Auth::check())
				@if(Auth::user()->isPerformer)
					@if($task->status == 'OPEN')
						<button onclick="location.href='/task/{{ $task->id }}/propose'">Запропонувати</button>
					@endif
				@endif
				@if(($task->performer_id == Auth::user()->id) || ($task->user == Auth::user()))
					@if($task->status != 'DONE')
						@if($task->status != 'CLOS')
							<form action = "/task/{{ $task->id }}/done" method = "POST">
							@csrf
							@if($task->status == 'PROG') 
								<button class = "done">Виконано</button>
							@endif
							@if($task->status == 'OPEN') 
								<button class = "red">Закрити</button>
							@endif
							</form>
						@endif
					@endif
				@endif
				@endif

				@if(session()->has('msg'))
					<span style="display: block; color: red; margin: 5px 0">
						{{ session()->get('msg') }}
					</span>
				@endif

				@if($task->performer == Auth::user())
					@if($task->status == 'DONE' || $task->status == 'CLOS')
						<button onclick="location.href='/task/{{ $task->id }}/review'">			Залишити відгук
						</button>
					@endif
				@endif

				@if($task->user == Auth::user())
					@if($task->status != 'DONE')
						@if($task->status != 'CLOS')
							<button class = "w75" onclick="location.href='/task/{{ $task->id }}/offers'">Пропозиції виконавців</button>
					
						@endif
					@endif
				@endif
			</span>
			<div class = "task__page__cost__info">
				<span class = "task__page__cost">
					{{ $task->cost }} грн
				</span>
				@if($task->cost_contract)
				<span class = "task__page__cost__additional">
					Ціна договірна
				</span>
				@endif
			</div>
		</div>

		<div class = "task__page__info">
			<ul>
				<li>
					<div class = "task__page__info__row">
						<span class = "label">Замовник</span>
						<div class = "spacer"></div>
						<a href = "/user/{{ $task->user_id }}">
							{{ $task->user->name }}
						</a>
					</div>
				</li>

				<li>
					<div class = "task__page__info__row">
						<span class = "label">Створено</span>
						<div class = "spacer"></div>
						<span class = "var">
							{{ $task->created_at->isoFormat('Do MMMM YYYY в HH:mm') }}
						</span>
					</div>
				</li>

				<li>
					<div class = "task__page__info__row">
						<span class = "label">Затверджено</span>
						<div class = "spacer"></div>
						<span class = "var">
							@if($task->accepted_at)
							{{ Carbon\Carbon::parse($task->accepted_at)->isoFormat('Do MMMM YYYY в HH:mm') }}
							@endif
						</span>
					</div>
				</li>

				<li>
					<div class = "task__page__info__row">
						<span class = "label">Виконано</span>
						<div class = "spacer"></div>
						<span class = "var">
							@if($task->done_at)
							{{ Carbon\Carbon::parse($task->done_at)->isoFormat('Do MMMM YYYY в HH:mm') }}
							@endif
						</span>
					</div>
				</li>
			</ul>
		</div>

		<div class = "task__page__details">
			<span class = "title">Деталі завдання</span>

			<div class = "task__page__details__row">
				<span class = "label">Термін виконання</span>
				<span class = "var">Почати: 
					<span>{{ date('d.m.Y', strtotime($task->needBeginDate)) }}</span>
				</span>
				<span class = "var">Закінчити: 
					<span>{{ date('d.m.Y', strtotime($task->needEndDate)) }}</span>
				</span>
			</div>
			<div class = "task__page__details__row">
				<span class = "label">Місто</span>
				<span class = "var">{{ $task->user->city }}</span>
			</div>

			<div class = "task__page__details__row">
				<span class = "label">Повний опис</span>
				<span class = "var">
					{{ $task->description }}
				</span>
			</div>
		</div>

		@if($task->status == 'PROG' || $task->status == 'DONE')
		<div class = "task__page__performer">
			<span class = "title">
				@if($task->status == 'PROG')
					Виконує
				@else
					Виконав
				@endif
			</span>
			<div class = "performer__info">
					<div class = "profile__picture big">
						<img src = "/storage/pictures/{{ $task->performer->picture }}" />
					</div>
				<div class = "performer__details">
					<span class = "performer__name">
						<a href = "/user/{{ $task->performer->id }}">
							{{ $task->performer->name }}
						</a>
					</span>
					<span class = "performer__city">Маріуполь</span>
					<span class = "label">Завдань виконано: 
						<span class = "var">
							{{ $task->performer->getDoneWorks->count() }}
						</span>
					</span>
					<span class = "label">Відгуків: 
						<span class = "var">
							{{ $task->performer->reviews->count() }} ({{ $task->performer->rating }}%)
						</span>
					</span>
				</div>

				<div class = "performer__grade">
				@if($task->review)
					<div class = "grades">
						<small class = "grades__title">Якість:</small>
							@for($i = 1; $i <= 5; $i++)
								@if($i <= $task->review->grade_quality)
									<i class = "rating__star active"></i>
								@else
									<i class = "rating__star"></i>
								@endif
							@endfor
					</div>
				@else
					@if($task->user == Auth::user())
						<button onclick="location.href='/task/{{ $task->id }}/review'">Залишити відгук</button>
					@endif
				@endif
				</div>
			</div>
		</div>
		@endif
	</div>
</section>
@endsection
