<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [UserController::class, 'register']);
Route::post('/store', [UserController::class, 'store']);
Route::get('/login', [UserController::class, 'login']);
Route::post('/loginstore', [UserController::class, 'loginstore']);
Route::get('/manager-dashboard', [UserController::class, 'managerdashboard']);
Route::get('/developer-dashboard', [UserController::class, 'developerdashboard']);
Route::get('/logout', [UserController::class, 'logout']);
