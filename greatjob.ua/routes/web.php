<?php
/*
	GET:	 /categories 			(index)
	GET:	 /categories/create 	(create)
	GET:	 /categories/1 			(show)
	POST:	 /categories 			(store)
	GET:	 /categories/1/edit 	(edit)
	PATCH:	 /categories/1 			(update)
	DELETE:	 /categories/1 			(destroy)
*/

//AUTH ROUTES
Auth::routes();

Route::get("/", 'HomeController@index');

Route::get('categories', 'CategoryController@index');
Route::get('category/{category}', 'CategoryController@show');

Route::get('tasks', 'TasksController@index');
Route::get('task/create', 'TasksController@create');
Route::post('tasks', 'TasksController@store');
Route::get('task/{task}', 'TasksController@show');
Route::get('task/{task}/propose', 'TasksController@propose');
Route::post('task/{task}/propose', 'TasksController@storePropose');
Route::get('task/{task}/offers', 'TasksController@offers');
Route::post('task/{task}/refuse', 'TasksController@refuse');
Route::post('task/{task}/accept/{performer}', 'TasksController@accept');
Route::post('task/{task}/done', 'TasksController@done');
Route::get('task/{task}/change', 'TasksController@change');
Route::post('task/{task}', 'TasksController@storeChanges');
Route::get('task/{task}/review', 'TasksController@createTaskReview');
Route::post('task/{task}/review', 'TasksController@storeReview');

Route::get('profile', 'UsersController@profile');
Route::get('profile/change', 'UsersController@change');
Route::post('profile/change', 'UsersController@update');
Route::get("user/{user}", 'UsersController@show');
Route::get("performers", 'UsersController@performers');

Route::get('register/performer', 'PerformerController@create');
Route::post('register/performer', 'PerformerController@store');
Route::get('register/performer/success', 'PerformerController@storeSuccess');

Route::get('reports', 'ReportsController@index');
Route::post('reports/users', 'ReportsController@storeUserReport');
Route::post('reports/tasks', 'ReportsController@storeTasksReport');



Route::prefix('admin')->group(function () {
	Route::get('/', 'AdminController@index');

});

