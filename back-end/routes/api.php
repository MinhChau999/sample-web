<?php

use App\Http\Controllers\ApiPostController;
use App\Http\Controllers\ApiUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [ApiUserController::class, 'register'])->name('register');
Route::post('/login', [ApiUserController::class, 'login'])->name('login');
Route::middleware('auth:api')->get('/user', [ApiUserController::class, 'infoUser'])->name('infoUser');
Route::middleware('auth:api')->resource('/post', ApiPostController::class);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

