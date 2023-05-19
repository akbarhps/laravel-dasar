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

Route::get('/products/{id}', function ($id) {
    return 'Product ID: ' . $id;
})->name('product.detail');

Route::get('/products/{productId}/items/{itemId}', function ($productId, $itemId) {
    return 'Product ID: ' . $productId . ', Items: ' . $itemId;
})->name('product.item.detail');

Route::get('/categories/{id}', function (string $categoryId) {
    return "Category ID: $categoryId";
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/users/{id?}', function (string $userId = '404') {
    return "User ID: $userId";
})->name('user.detail');

Route::get('/conflict/hello', function () {
    return "Conflict Hello World";
});

Route::get('/conflict/{name}', function (string $name) {
    return "Conflict $name";
});

Route::get('/produk/{id}', function (string $id) {
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});

Route::get('/product-redirect/{id}', function (string $id) {
    return redirect()->route('product.detail', ['id' => $id]);
});

Route::get('/controller/hello/request', [App\Http\Controllers\HelloController::class, 'request']);

Route::get('/controller/hello/{name}', [App\Http\Controllers\HelloController::class, 'hello']);

Route::fallback(function () {
    return "404 Not Found";
});
