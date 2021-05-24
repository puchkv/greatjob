@extends('layouts.layout')

@section('title', 'Панель управління завданням - GreatJob')

@section('content')
<section>
	<div class = "task__change">
		<span class = "title">Панель управління - Завдання №{{ $task->id }}</span>
		@if ($errors->any())
		    <div class="alert danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<form class = "custom__form" method="POST"
			action = "/task/{{ $task->id }}">
			@csrf
			<div>
				<label for = "title">Назва</label>
				<input type = "text" name = "title" placeholder="Що треба зробити" 
					value = "{{ $task->title }}" required minlength="4" />
			</div>
			<span class = "title">Опис</span>
			<div>
				<label for = "description">Опишіть детальніше</label>
				<textarea name = "description">{{ $task->description }}</textarea>
			</div>
			<div>
				<label for = "contacts">Контактні дані</label>
				<textarea name = "contacts" 
				placeholder="Наприклад: Іванов Іван Іванович м. Маріуполь, вул. Університетьска 5, +380504322233">{{ $task->contacts }}</textarea>
				<span style="color: red; font-size: 14px">Ці дані зможе побачити тільки обраний вами виконавець</span>
			</div>

			<span class = "title">Дата та час</span>
			<div>
				<label for = "needBeginDate">Почати з</label>
				<input type = "date" name = "needBeginDate" id="beginDate" placeholder="Дата" value = "{{ $task->needBeginDate }}">
			</div>
			<div>
				<label for = "needEndDate">Завершити до</label>
				<input type = "date" name = "needEndDate" id="endDate" placeholder="Дата"
				value = "{{  $task->needEndDate }}">
			</div>

			<span class = "title">Ціна</span>
			<div>
				<label for = "cost">Укажіть ціну</label>
				<input type = "text" name = "cost" id = "taskCost" class = "task__cost" value = "{{ $task->cost }}" maxlength="7" minlength="2" pattern="{0-9}">
				<label for = "taskCost"> грн</label>
				<label class = "checkbox__container" for = "treaty">Договірна
					<input type = "checkbox" name = "cost_contract" id = "treaty" {{ $task->cost_contract ? 'checked' : "" }}>
					<span class = "checkmark"></span>
				</label>
			</div>
			<div>
				<button class = "w50">Зберегти</button>
			</div>
		</form>
	</div>
</section>
@endsection