@extends('layouts.layout')

@section('title', 'Моя сторінка')

@section('content')

<section>
	<div class = "content w50" style="padding: 30px">
		<span class = "title">Змінити профіль</span>
		 @if ($errors->any())
            <div class="alert danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
		<form class = "custom__form" method="POST" action="/profile/change" enctype="multipart/form-data">
			@csrf
			<div>
				<label>Ім'я</label>
				<input name = "name" type = "text" value = "{{ $user->name }}" required />
			</div>
			<div>
				<label>Телефон</label>
				 <input type = "tel" name = "phone" required autocomplete="phone" value="{{ $user->phone }}" pattern="[0-9]{10}" maxlength="10" required />
			</div>
			<div>
				<label>Місто</label>
				<input type = "text" name = "city" placeholder = "Місто" value="{{ $user->city }}" maxlength="50" required />
			</div>
			<div>
				<label>Зображення</label>
				<input type="file" name="picture" aria-describedby="fileHelp" accept="image/x-png,image/gif,image/jpeg">
				<small id="fileHelp">
					Будь ласка оберіть існуюче зображення.
					Його вага має бути менш ніж 2MB
				</small>
			</div>
			<div>
				<input type = "submit" value = "Зберегти" />
			</div>
		</form>
	</div>
</section>

@endsection