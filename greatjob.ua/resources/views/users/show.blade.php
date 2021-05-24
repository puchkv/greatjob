@extends('layouts.layout')

@section('title', $user->name . ' - GreatJob')

@section('content')

<section>
	<div class = "content">
		<div class = "content__header">
			<div class = "profile__picture big">
				<img src = "/storage/pictures/{{ $user->picture }}">
			</div>

			<div class = "user__profile">
				<span class = "user__profile__name">
					<span>{{ $user->name }}</span> 
					@if($user->verified)
					<div class = "user__profile__verified" title = "Підтверджено">
						<span class = "mark"></span>
					</div>
					@endif
				</span>
				<span class = "user__profile__role">{{ $user->getUserRole() }}</span>
				<span class = "user__profile__city">{{ $user->city }}</span>
			</div>
			<div class = "user__counters">
			@if($user->isPerformer)
				<div class = "user__counters__works">
					<span>{{ $user->getDoneWorks->count() }}</span>
					<span>Виконано робіт</span>
				</div>
			@endif
				<div class = "user__counters__tasks">
					<span>{{ $user->tasks->count() }}</span>
					<span>Створено завдань</span>
				</div>
			</div>
		</div>

		<div class = "content__info">
			<div class = "content__info__left">

			@if($tasks != null)
			@if($tasks->count() > 0)
				<span class = "title">Створені завдання</span>
				<ul class = "user__tasks">
				@foreach($tasks as $task)
					<li>
						<span style="color:#777; font-size: 12px">№{{ $task->id }}</span>
						<a href="/task/{{ $task->id }}">
							{{ $task->title }}
						</a>
						<span style="color:#777; font-size: 12px">({{ $task->getStatusName($task->status) }})</span>
						<span class = "user__tasks__date">{{ $task->created_at->isoFormat('Do MMMM YYYY в HH:mm') }}</span>
					</li>
				@endforeach
				</ul>
			@endif
			@endif

		@if($user->isPerformer)
			@if($user->about != null)
				<span class = "title">Про виконавця</span>
				<div class = "user__about">
					<p>
						{{ $user->about }}
					</p>
				</div>
			@endif

			@if($user->category_prices != null)
			@if($user->category_prices->count() > 0)
				<span class = "title">Послуги та ціни</span>
				<div class = "user__pricelist">
					<ul>
						@foreach($user->category_prices as $cat)
							<li>
								<div class = "price__line">
									<a href = "/category/{{ $cat->category->slug }}">{{ $cat->category->name }}</a>
									<div class = "spacer"></div>
									<span>{{ $cat->price }} грн</span>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			@endif
			@endif

			@if($examples != null)
			@if($examples->count() > 0)
			<span class = "title">Приклади робіт</span>
			<div class  = "user__examples" id = "examples">
				@foreach($examples as $example)
					<div class = "example square" style = "
						background: url('/storage/examples/{{ $example->example_picture }}'); 
						background-position: center center;
						background-repeat: no-repeat;
						background-size: cover">
						<div class = "overlay">
							<img src = "{{ URL::asset('/images/icons/search.svg') }}">
						</div>
					</div>

				@endforeach
				@include('includes/modal_image_window')
				<div class = "pagination_container" id = "pagination-container">
					{{  $examples->links() }}
				</div>
			</div>
			@endif
			@endif
		@endif

			@if($reviews != null)
			@if($reviews->count() > 0)
			<span class = "title">Відгуки</span>
			<ul class = "user__reviews">
			@foreach($reviews as $review)	
				<li class = "review__row">
					<div class = "reviewer__info">
						<div class = "profile__picture">
							<img src = "/storage/pictures/{{ $review->from_user->picture }}">
						</div>
						<span class = "reviewer__name">
							<a href = "/user/{{ $review->from_user->id }}">
								{{ $review->from_user->name }}
							</a>
						</span>
						<span class = "reviewer__role">
							{{ $review->from_user->getUserRole() }}
						</span>
					</div>
					<div class = "review__content">
						<span class = "review__task">
							Відгук на завдання: 
							<a href = "/task/{{ $review->task_id }}">
								{{ $review->task->title }}
							</a>
						</span>
						<span class = "review__message">
							{{ $review->message }}
						</span>
						
						<span class = "review__date">
							{{ $review->created_at->isoFormat('Do MMMM HH:mm') }}
						</span>
					</div>

					<div class = "review__grades">
						<span>
							<small class="grades__title">Оцінка:</small>
							@if($user->isPerformer)
								<span class = "grade">{{ $review->to_user->getPerformerGrade($review) }}</span>
							@else
								<span class = "grade">{{ $review->to_user->getUserGrade($review) }}</span>
							@endif
							@if($user->isPerformer)
							<div class = "grades">
								<small class = "grades__title">Швидкість:</small>
									@for($i = 1; $i <= 5; $i++)
										@if($i <= $review->grade_speed)
											<i class = "rating__star active"></i>
										@else
											<i class = "rating__star"></i>
										@endif
									@endfor
							</div>
							<div class = "grades">
								<small class = "grades__title">Ціна:</small>
									@for($i = 1; $i <= 5; $i++)
										@if($i <= $review->grade_cost)
											<i class = "rating__star active"></i>
										@else
											<i class = "rating__star"></i>
										@endif
									@endfor
							</div>
							<div class = "grades">
								<small class = "grades__title">Якість:</small>
									@for($i = 1; $i <= 5; $i++)
										@if($i <= $review->grade_quality)
											<i class = "rating__star active"></i>
										@else
											<i class = "rating__star"></i>
										@endif
									@endfor
							</div>
							@endif
						</span>
					</div>
				</li> 
			@endforeach
			</ul>
			<div class = "pagination_container">
				{{ $reviews->links() }}
			</div> 
			@endif
			@endif
		</div>

			<div class = "content__info__right">
				<div class = "user__progress">
					<div class = "progress p{{ round($user->rating) }} big {{ $user->getRatingColor() }}">
						<span>{{ round($user->rating) }}%</span>
						<div class = "slice">
							<div class = "bar"></div>
							<div class = "fill"></div>
						</div>
					</div>
					<div class = "user__rating">Рейтинг користувача</div>
					<div class = "user__reviews">Цей користувач має {{ round($user->rating) }}% позитивних відгуків</div>
					<!--@if($user->isPerformer)
						<button>Запропонувати завдання</button>
					@endif-->
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('scripts')
<script src = "{{ URL::asset('js/jquery-3.4.1.min.js') }}"></script>
<script>

	var current_div;

	$(".example").click(function() {
		current_div = $(this);
		var img = $(this).css('background-image');
		img = img.replace('url(','').replace(')','').replace(/\"/gi, "");
		
		$(".modal").fadeIn(200, function() {
			$("#modal__image").attr("src", img);
		}); 
	});

	$(".modal__control__left").click(function () {
		current_div.closest('.example').prev().trigger('click');
	});

	$(".modal__control__right").click(function () {
		current_div.closest('.example').next().trigger('click');
	});

	$(".modal__close").click(function () {
		$(".modal").fadeOut(200, function() {
			$("#modal__image").attr("src", "");
			$(this).hide();
		});
	});

</script>

@endsection