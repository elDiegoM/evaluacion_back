<?php

use App\Http\Controllers\Auth\UserController\UserController;
use App\Http\Controllers\LoginController\LoginController;
use App\Http\Controllers\MovieController\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('login', [LoginController::class, 'login']);
Route::resource('user', UserController::class);
Route::get('getlogs', [UserController::class, 'getLogs']);



Route::get('movies/list/{id_page}', [MovieController::class, 'index']);
Route::get('movies/search/{name}', [MovieController::class, 'show']);
Route::post('movies/addfavorite/{account_id}/{movie_id}', [MovieController::class, 'markFavorite']);
Route::get('movies/getfavorites/{account_id}', [MovieController::class, 'getFavorites']);




