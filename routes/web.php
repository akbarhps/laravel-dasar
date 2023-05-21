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

Route::get('/input/hello', [App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello', [App\Http\Controllers\InputController::class, 'hello']);

Route::post('/input/hello/first', [App\Http\Controllers\InputController::class, 'helloFirst']);

Route::post('/input/hello/input', [App\Http\Controllers\InputController::class, 'helloInput']);

Route::post('/input/hello/array', [App\Http\Controllers\InputController::class, 'arrayInput']);

Route::post('/input/hello/type', [App\Http\Controllers\InputController::class, 'inputType']);

Route::post('/input/filter/only', [App\Http\Controllers\InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [App\Http\Controllers\InputController::class, 'filterExcept']);

Route::post('/input/filter/merge', [App\Http\Controllers\InputController::class, 'filterMerge']);

Route::post('/file/upload', [App\Http\Controllers\FileController::class, 'upload']);

Route::get('/response/hello', [App\Http\Controllers\ResponseController::class, 'response']);
Route::get('/response/header', [App\Http\Controllers\ResponseController::class, 'header']);

Route::get('/response/type/view', [App\Http\Controllers\ResponseController::class, 'responseView']);
Route::get('/response/type/json', [App\Http\Controllers\ResponseController::class, 'responseJSON']);
Route::get('/response/type/file', [App\Http\Controllers\ResponseController::class, 'responseFile']);
Route::get('/response/type/download', [App\Http\Controllers\ResponseController::class, 'responseDownload']);

Route::get('/cookie/set', [App\Http\Controllers\CookieController::class, 'createCookie']);
Route::get('/cookie/get', [App\Http\Controllers\CookieController::class, 'getCookie']);
Route::get('/cookie/clear', [App\Http\Controllers\CookieController::class, 'clearCookie']);

Route::get('/redirect/from', [App\Http\Controllers\RedirectController::class, 'redirectFrom']);
Route::get('/redirect/to', [App\Http\Controllers\RedirectController::class, 'redirectTo']);

Route::get('/redirect/name', [App\Http\Controllers\RedirectController::class, 'redirectName']);
Route::get('/redirect/action', [App\Http\Controllers\RedirectController::class, 'redirectAction']);
Route::get('/redirect/name/{name}', [App\Http\Controllers\RedirectController::class, 'redirectHello'])
    ->name('redirect-hello');

Route::get('/redirect/away', [App\Http\Controllers\RedirectController::class, 'redirectAway']);

Route::fallback(function () {
    return "404 Not Found";
});
