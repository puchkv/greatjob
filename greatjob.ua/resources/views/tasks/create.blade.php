@extends('layouts.layout')

<style>
input[type=number] {
    -webkit-appearance: textfield;
       -moz-appearance: textfield;
            appearance: textfield;
  }
  input[type=number]::-webkit-inner-spin-button, 
  input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
  }
</style>

@section('content')
<section>
	<div class = "create__task__container">
		<div class = "title">Створення завдання</div>
		@if ($errors->any())
		    <div class="alert danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<form class = "create__task__form custom__form" method="POST"
			action = "/tasks">
			@csrf
			<div class = "create__task__form__row">
				<label for = "title">Назва</label>
				<input type = "text" name = "title" placeholder="Що треба зробити" 
					value = "{{ old('title') }}" required minlength="4" />
			</div>
			<div class = "create__task__form__row">
				<label for = "category">Оберіть категорію</label>
				<select name = "category">
				@foreach($categories as $category)
				<optgroup label = "{{ $category->name }}">
					@foreach($category->subCategories as $subCategory)
					<option value="{{ $subCategory->id }}">
						{{ $subCategory->name }}
					</option>
					@endforeach
				</optgroup>
				@endforeach
				</select>
			</div>

			<span class = "title">Опис</span>
			<div class = "create__task__form__row">
				<label for = "description">Опишіть детальніше</label>
				<textarea name = "description"> {{ old('description') }}</textarea>
			</div>
			<div class = "create__task__form__row">
				<label for = "contacts">Контактні дані</label>
				<textarea name = "contacts" 
				placeholder="Наприклад: Іванов Іван Іванович м. Маріуполь, вул. Університетьска 5, +380504322233">{{ old('contacts') }}</textarea>
				<span style="color: red; font-size: 14px">Ці дані зможе побачити тільки обраний вами виконавець</span>
			</div>

			<span class = "title">Дата та час</span>
			<div class = create__task__form__row>
				<label for = "needBeginDate">Почати з</label>
				<input type = "date" name = "needBeginDate" id="beginDate" placeholder="Дата" value = "{{ old('needBeginDate') ? old('needBeginDate') : date('Y-m-d') }}">
			</div>
			<div class = create__task__form__row>
				<label for = "needEndDate">Завершити до</label>
				<input type = "date" name = "needEndDate" id="endDate" placeholder="Дата"
				value = "{{ old('needBeginDate') ? old('needBeginDate') : date('Y-m-d') }}">
			</div>

			<span class = "title">Ціна</span>
			<div class = "create__task__form__row">
				<label for = "cost">Укажіть ціну</label>
				<input type = "number" name = "cost" id = "taskCost" class = "task__cost"
				value = "{{ old('cost') }}" maxlength="7" minlength="2">
				<label for = "taskCost"> грн</label>
				<label class = "checkbox__container" for = "treaty">Договірна
					<input type = "checkbox" name = "cost_contract" id = "treaty" {{ old('cost_contract') == "on" ? 'checked' : "" }}>
					<span class = "checkmark"></span>
				</label>
			</div>
	{{-- 		<div class = "create__task__form__about">
				<div class = "title">Контактні дані</div>
				<input type = "text" name = "user_name" placeholder="ПІБ" value = "{{ old('user_name') }}">
				<input type = "email" name = "user_email" placeholder="E-mail" value = "{{ old('user_email') }}">
				<input type = "tel" pattern="[0-9]{10}" maxlength="10" name = "user_phone" placeholder="Телефон" value = "{{ old('user_phone') }}">
				<span>Маєте аккаунт? <a href = "#">Війти</a></span>
			</div>
 --}}
			<div class = "create__task__form__row">
				<label class = "checkbox__container" for = "rules_agree">
					З правилами сервісу згоден
					<input type = "checkbox" name = "rulesAgree" id = "rules_agree" {{ old('rulesAgree') == "on" ? 'checked' : "" }} >
					<span class = "checkmark"></span>
				</label>
			</div>

			<div class = "create__task__form__row">
				<button type = "submit">Опубліковати</button>
			</div>
		</form>
	</div>
</section>

{{-- <script>
	var element = document.getElementById("dateType");

	var beginInput = document.getElementById('beginDate');
	var endInput = document.getElementById('endDate');
	beginInput.style.display = "block";
	endInput.style.display = "none";
	
	element.onchange = function() {
		switch(element.options[element.selectedIndex].value)
		{
			case 'start':
				beginInput.style.display = "block";
				endInput.style.display = "none";
				endInput.valueAsDate = null;
				break;
			case 'end':
				beginInput.style.display = "none";
				endInput.style.display = "block";
				beginInput.valueAsDate = null;
				break;
			default:
				beginInput.style.display = "block";
				endInput.style.display = "block";
		}
	}
</script> --}}

@endsection