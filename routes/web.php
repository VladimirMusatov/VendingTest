<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

//Главная страница
Route::get('/',[MainController::class,'index'])->name('index');

//Форма для ввода купюры
Route::get('/form',[MainController::class,'form'])->name('form');
//Сохранение денег
Route::get('/store',[MainController::class,'store'])->name('store');

//Сдача
Route::get('/surplus',[MainController::class,'surplus'])->name('surplus');

//Покупка товра
Route::get('/buy/{id}',[MainController::class,'buy'])->name('buy');