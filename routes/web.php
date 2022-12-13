<?php
  use Illuminate\Support\Facades\Route;
  use App\Http\Controllers\UserController;

  Route::get('usuarios', [UserController::class, "show"]);
  Route::get('users/{id}', 'UserController@show');
  Route::post('users', 'UserController@store');
  Route::put('users/{id}', 'UserController@update');
  Route::delete('users/{id}', 'UserController@delete');