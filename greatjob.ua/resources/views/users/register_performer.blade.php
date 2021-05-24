@extends('layouts.layout')

@section('title', 'Реєстрація виконавця')

@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

<section>
	<div class = "container">
		<span class="title">Реєстрація виконавця</span>
		<form id = "form" method="POST" action = "" class = "custom__form w75">
			@csrf
			<div>
				<label>Розкажіть про себе</label>
				<textarea id = "about" placeholder="Тут має бути будь-яка інформація о Вас. Можете залишити контактні дані,  ця інформація допоможе замовникам обрати саме Вас." 
				name = "about" minlength="20" required></textarea>
			</div>
			<div>
				<span class = "title">Додайте категорії в яких ви працюєте</span>
				<select id="category_select">
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
			<div>
				<input type = "button" onclick="addCategory()" value="Додати категорію"/>
			</div>
			<div>
				<table id = "categories">
				</table>
			</div>
			<div>
				<span class = "title">Завантажте приклади своїх робіт (якщо маєте)</span>
				<input type = "button" onclick="addExample()" value = "Додати приклад"/>
				<table id = "examples">
				</table>
			</div>
			<div>
				<input type="submit" class = "w100" value = "Стати виконавцем">
			</div>
	</div>
</section>
@endsection

@section('scripts')
<script src = "{{ URL::asset('js/jquery-3.4.1.min.js') }}"></script>
<script>
	function addCategory() {
		var e = document.getElementById("category_select");
		var catId = e.options[e.selectedIndex].value;
		var catName = e.options[e.selectedIndex].innerHTML;
		catName = catName.replace(/(^\s+|\s+$)/g, '');
		
		var table = document.getElementById('categories');
		var rowCount = table.rows.length;

		for(var i = 0; i < rowCount; i++)
			if(catName == document.getElementsByName('category')[i].value)
				return;

		var tr = table.insertRow(rowCount);

		var td = document.createElement('td');

		td = tr.insertCell(0);
		var element = document.createElement('input');
		element.style = "font-size: 16px; border: 0; width: 90%";
		element.readOnly = true;
		element.setAttribute('value', catName);
		element.setAttribute('class', 'category' + rowCount);
		element.setAttribute('id', catId);
		element.setAttribute('name', 'category');
		td.appendChild(element);

		td = tr.insertCell(1);
		element = document.createElement('input');
		element.setAttribute('type', 'text');
		element.setAttribute('name', 'cost');
		element.setAttribute('placeholder', 'Ціна');
		element.setAttribute('maxlength', '8');
		element.setAttribute('minlength', '2');
		element.required = 'true';
		element.onkeypress = function() {
			var e = event || evt; // for trans-browser compatibility
			var charCode = e.which || e.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57))
			    return false;
			return true;
		};
		td.appendChild(element);

		td = tr.insertCell(2);
		element = document.createElement('span');
		element.setAttribute('onclick', 'removeRow(this, '+table.id+')');
		element.innerHTML = '&times;';
		element.style = "font-size: 48px; cursor: pointer";
		td.appendChild(element);
	}

	function removeRow(oSpan, e)
	{
		e.deleteRow(oSpan.parentNode.parentNode.rowIndex);
	}

	function addExample()
	{
		var e = document.getElementById('examples');
		var rowCount = e.rows.length;

		var tr = e.insertRow(rowCount);

		var td = document.createElement('td');
		td = tr.insertCell(0);
		var element = document.createElement('input');
		element.setAttribute('type', 'file');
		element.setAttribute('id', 'file');
		element.setAttribute('accept', 'image/x-png,image/gif,image/jpeg');
		element.setAttribute('name', 'example');
		element.required = 'true';
		td.appendChild(element);

		td = tr.insertCell(1);
		element = document.createElement('span');
		element.setAttribute('onclick', 'removeRow(this,'+ e.id +')');
		element.innerHTML = '&times;';
		element.style = "font-size: 48px; cursor: pointer";
		td.appendChild(element);
	}

$(document).ready(function() {
	$("#form").submit(function(e) {
		e.preventDefault();

		var user_examples = document.getElementsByName('example');
		var user_cats = document.getElementsByName('category');
		var user_costs = document.getElementsByName('cost');

		if(user_cats.length == 0) {
			alert("Будь ласка оберіть категорії");
			return;
		}

		var form_data = new FormData();
		var categories = new Array();

		form_data.append('_token', $('meta[name="csrf-token"]').attr('content'));
		form_data.append('about', $("#about").val());


		for(var j = 0; j < user_examples.length; j++)
		{
			if(user_examples[j].files.length == 0) {
				return alert('Додайте зображення або видаліть поле'); }
			form_data.append('examples[]', user_examples[j].files.item(0));
		}

		for(var i = 0; i < user_cats.length; i++) {
			if(user_costs[i].value != "")
			{
				categories.push({
					category_id : user_cats[i].id,
					cost : user_costs[i].value
				});
			}
			else
			{
				return alert('Не має бути пустих полей');
			}
		}

		form_data = appendFormData(form_data, categories, 'categories');

		$.ajax ({
			type: 'POST',
			url: '{{ url("register/performer") }}',
	        dataType: 'json',
	        data: form_data,
	        async: false,
	        processData: false,
    		contentType: false,
	        success: function(res) {
	        	console.log(res);
	           	window.location.replace('/register/performer/success');
	        },
	        error: function(jqXHR, textStatus, errorThrown) { 
        		console.log(JSON.stringify(jqXHR));
        		console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
    		}
		});	
	});
});

function appendFormData(formData, data, key) {
    if ( ( typeof data === 'object' && data !== null ) || Array.isArray(data) ) {
        for ( let i in data ) {
            if ( ( typeof data[i] === 'object' && data[i] !== null ) || Array.isArray(data[i]) ) {
                appendFormData(formData, data[i], key + '[' + i + ']');
            } else {
                formData.append(key + '[' + i + ']', data[i]);
            }
        }
    } else {
        formData.append(key, data);
    }

    return formData;
}
</script>

@endsection