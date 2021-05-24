@extends('layouts.layout')

@section('title', $category->name)

@section('content')
<section>
	<div class = "task__list">
		<span class = "task__list__dir">
			 @if($category->parent != NULL)
			<span>
				<a href="/category/{{ $category->parent->slug }}">
					{{ $category->parent->name }}
				</a>
			</span>
			<span class = "nav__arrow right"></span>
			@endif
			<span>
				<a href="/category/{{ $category->slug }}">
					{{ $category->name }}
				</a>
			</span> 
			<h3><a href="/categories">Усі категорії</a></h3>
			@if($category->parent == NULL)
			<div class = "subcategories">
				@foreach($category->subCategories as $cat)
					<a href = "/category/{{ $cat->slug }}">
						{{ $cat->name }}
					</a>
				@endforeach
			</div>
			@endif
		</span>

	@foreach($tasks as $task)
		<div class = "task">
			<div class = "task__owner">
				<div class = "profile__picture">
					<img src = "../storage/pictures/{{ $task->user->picture }}">
				</div>
				<span class = "task__owner__name">
					<a href = "/user/{{ $task->user_id }}">
						{{ $task->user->name }}
					</a>
				</span>
			</div>
			<div class = "task__content">
				<a href = "/task/{{ $task->id }}" class = "task__title">
					{{ $task->title }}
				</a>

				<p class = "task__desc" id = "task_desc">
					{{ str_limit($task->description, 180) }}
				</p>
				<span class = "task__date">
					Створено: 
					{{ $task->created_at->isoFormat('Do MMMM YYYY в HH:mm') }}
				</span>
			</div>

			<div class = "task__sidebar">
				<span class = "task__cost" style="color: orange">
					{{ $task->cost }} грн
				</span>
				<span style="display: block; text-align: center; font-size: 14px; margin-bottom: 10px">
					@if($task->cost_contract)
						Ціна договірна
					@endif
				</span>
				@if(Auth::check())
					@if(Auth::user()->isPerformer)
						@if(Auth::user()->id != $task->user_id)
							<button onclick="location.href='/task/{{ $task->id }}/propose'">Запропонувати</button>
						@endif
					@endif
				@endif
			</div>
		</div>
	@endforeach
	</div>
</section>
@endsection