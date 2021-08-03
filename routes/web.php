<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\RestTestController;
=======
>>>>>>> e14e05b... Выполнены лишь миграции

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
<<<<<<< HEAD

Route::resource('rest', RestTestController::class)->names('restTest');
=======
>>>>>>> e14e05b... Выполнены лишь миграции
