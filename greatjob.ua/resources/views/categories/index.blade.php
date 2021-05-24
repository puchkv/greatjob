@extends('layouts.layout')

@section('styles')
<style>
	.container
	{
		display: flex;
		flex-flow: row wrap;
		padding: 20px;
		justify-content: center;
	}

	.category
	{
		flex: 1 1 200px;
	}

	.category span
	{
		font-size: 26px;
	}

	.category ul
	{
		padding-left: 20px;
		line-height: 1.9em;
	}

	.category ul li a
	{
		color: #777
	}
</style>
@endsection

@section('content')
<section>
	<span class = "title">Усі категорії</span>
	<div class = "container">
	@foreach($categories as $category)
		<div class = "category">
			<span>
				<a href="/category/{{ $category->slug }}">
					{{ $category->name }}
				</a>
			</span>
			@if($category->subCategories->count() > 0)
			<ul>
				@foreach($category->subCategories as $subCategory)
				<li>
					<a href="/category/{{ $subCategory->slug }}">
						{{ $subCategory->name }}
					</a>
				</li>
				@endforeach
			</ul>
			@endif
		</div>
		@endforeach
	</div>
</section>
@endsection