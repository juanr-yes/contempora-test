<?php
  use Illuminate\Support\Facades\Route;
  use App\Http\Controllers\UserController;

  Route::get('usuarios', [UserController::class, "show"]);
  Route::post('usuarios', [UserController::class, "store"]);
  Route::put('usuarios', [UserController::class, "update"]);