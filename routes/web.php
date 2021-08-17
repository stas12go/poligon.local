<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::prefix('blog')->namespace('Blog')->group(function () {
    Route::resource('posts', 'PostController')->names('blog.posts');
});

Route::prefix('admin/blog')->namespace('Blog\Admin')->group(function () {
    $methods = ['index', 'edit', 'store', 'update', 'create'];

    Route::resource('categories', 'CategoryController')
        ->only($methods)
        ->names('blog.admin.categories');

    Route::resource('posts', 'PostController')
        ->except('show')
        ->names('blog.admin.posts');
});
