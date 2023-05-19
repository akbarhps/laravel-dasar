<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return 'Hai';
});

//Route::view('/hello', 'hello', ['name' => 'John Doe']);
Route::get('/hello-view', function () {
    return view('hello', ['name' => 'John Doe']);
});

Route::get('/world', function () {
    return view('hello.world', ['name' => 'John Doe']);
});

Route::redirect('/hi', '/hello');

Route::fallback(function() {
    return "404 Not Found";
});
