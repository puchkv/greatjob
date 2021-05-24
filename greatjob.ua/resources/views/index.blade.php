@extends('layouts.layout')

@section('styles')
@endsection

@section('content')
<section>
	@include ('includes.slider')

    <article class="categories">
    	<div class="categories__wrap">
    		@foreach($categories as $category)
    		<div>
    			<span>
    				<a href="category/{{ $category->slug }}">
    					{{ $category->name }}
    				</a>
    			</span>
                <ul>
                @foreach($category->subCategories as $subCategory)
                    <li>
                        <a href="/category/{{ $subCategory->slug }}">
                            {{ $subCategory->name }}
                        </a>
                        <span>
                            {{ $subCategory->tasks()->where('status', 'OPEN')->count() }}
                        </span>
                    </li>
                @endforeach
                </ul>  
    		</div>
    		@endforeach
    	</div>

    <article class = "tasks">
        <span class = "tasks__title">Останні завдання</span>
        <div class = "tasks__wrap">
            @foreach($tasks as $task)
            <div class = "task">
                <div class = "task__header">
                    <div class = "profile__picture small">
                        <img src = "storage/pictures/{{ $task->user->picture }}" />
                    </div>

                    <a href ="/user/{{ $task->user->id }}" class = "task__header__username">
                        {{ $task->user->name }}
                    </a>

                    <span class = "task__header__date">
                       {{ $task->created_at->isoFormat('Do MMMM HH:mm') }}
                    </span>
                </div>

                <div class = "task__content">
                    <div class = "task__content__header">
                        <a href = "/task/{{ $task->id }}">
                            {{ $task->title }}
                        </a>
                        <span class = "cost">
                            {{ $task->cost }} грн
                        </span>
                    </div>
                    <p class = "task__content__text">
                        {{ str_limit($task->description, 220) }}
                    </p>
                </div>
            </div>
            @endforeach
    </article>
</section>
@endsection

@section('scripts')
<script src = "{{ URL::asset('js/jquery-3.4.1.min.js') }}"></script>
<script src = "{{ URL::asset('js/slick.min.js') }}"></script>

<script>
</script>
@endsection

