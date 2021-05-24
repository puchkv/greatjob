<article class = "slider">
	<input id = "slide1" class = "slider__control" type = "radio" name = "slider" checked = "checked" />
	<input id = "slide2" class = "slider__control" type = "radio" name = "slider" />
	<div class = "slider__track" id = "slider_js">
		<div class = "slider__slide">
			<div class = "slider__slide__content">
				<span>
					Приєднуйтесь до команди виконавців Great Job
				</span>
				<p>
					Реєструйте анкету виконавця, виконуйте завдання, розвивайтеся, ставте перед собою нові мети та заробляйте на тому, що вмієте.
				</p>
				@if(!Auth::check())
					<button type="button" onclick="location.href='/register'">Зареєструватись</button>
				@else
					<button type="button" onclick="location.href='/register/performer'">Стати виконавцем</button>
				@endif
			</div>
		</div>
		<div class = "slider__slide">
			<div class = "slider__slide__content">
				<span>
					Ми допоможемо знайти надійного виконавця
				</span>
				<p>
					На Great Job зареєстровано вже 3423 виконавця та 12 будівельних компаній, які готові вирішити Ваше завдання! 
				</p>
				<button type="button" onclick="location.href='/task/create'">Створити завдання</button>
			</div>
		</div>
	</div>
	<div class = "slider__indicators">
		<label class = "slider__indicator" for = "slide1"></label>
		<label class = "slider__indicator" for = "slide2"></label>
	</div>
</article>