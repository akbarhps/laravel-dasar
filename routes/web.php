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
Route::prefix('/input')->group(function () {
    Route::post('/hello', [App\Http\Controllers\InputController::class, 'hello']);
    Route::post('/hello/first', [App\Http\Controllers\InputController::class, 'helloFirst']);
    Route::post('/hello/input', [App\Http\Controllers\InputController::class, 'helloInput']);
    Route::post('/hello/array', [App\Http\Controllers\InputController::class, 'arrayInput']);
    Route::post('/hello/type', [App\Http\Controllers\InputController::class, 'inputType']);
    Route::post('/filter/only', [App\Http\Controllers\InputController::class, 'filterOnly']);
    Route::post('/filter/except', [App\Http\Controllers\InputController::class, 'filterExcept']);
    Route::post('/filter/merge', [App\Http\Controllers\InputController::class, 'filterMerge']);
});

Route::post('/file/upload', [App\Http\Controllers\FileController::class, 'upload'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/response/hello', [App\Http\Controllers\ResponseController::class, 'response']);
Route::get('/response/header', [App\Http\Controllers\ResponseController::class, 'header']);

Route::prefix('/response/type')->group(function () {
    Route::get('/view', [App\Http\Controllers\ResponseController::class, 'responseView']);
    Route::get('/json', [App\Http\Controllers\ResponseController::class, 'responseJSON']);
    Route::get('/file', [App\Http\Controllers\ResponseController::class, 'responseFile']);
    Route::get('/download', [App\Http\Controllers\ResponseController::class, 'responseDownload']);
});

Route::prefix('/cookie')
    ->controller(\App\Http\Controllers\CookieController::class)
    ->group(function () {
        Route::get('/set', 'createCookie');
        Route::get('/get', 'getCookie');
        Route::get('/clear', 'clearCookie');
    });

Route::prefix('/redirect')
    ->controller(\App\Http\Controllers\RedirectController::class)
    ->group(function () {
        Route::get('/from', 'redirectFrom');
        Route::get('/to', 'redirectTo');
        Route::get('/name', 'redirectName');
        Route::get('/action', 'redirectAction');
        Route::get('/away', 'redirectAway');
        Route::get('/name/{name}', 'redirectHello')
            ->name('redirect-hello');
        Route::get('/named', function () {
//            return route('redirect-hello', ['name' => 'John Doe']);
//            return url()->route('redirect-hello', ['name' => 'John Doe']);
            return \Illuminate\Support\Facades\URL::route('redirect-hello', ['name' => 'John']);
        });
    });

Route::middleware(['contoh:api,401'])->group(function () {
    Route::get('/middleware/api', function () {
        return "OK";
    });
    Route::get('/middleware/group', function () {
        return "GROUP";
    });
});

Route::get('/form', [App\Http\Controllers\FormController::class, 'form']);
Route::post('/form', [App\Http\Controllers\FormController::class, 'submitForm']);

Route::get('/url/full', function () {
    return \Illuminate\Support\Facades\URL::full();
});

Route::get('/url/action', function () {
//    return action([\App\Http\Controllers\FormController::class, 'form'], []);
//    return url()->action([\App\Http\Controllers\FormController::class, 'form'], []);
    return \Illuminate\Support\Facades\URL::action([\App\Http\Controllers\FormController::class, 'form'], []);
});

Route::get('/session/create', [App\Http\Controllers\SessionController::class, 'createSession']);
Route::get('/session/get', [App\Http\Controllers\SessionController::class, 'getSession']);

Route::get('/error/sample', function () {
    throw new Exception('Sample error');
});

Route::get('/error/manual', function () {
    report(new Exception('Sample error'));
    return "Error reported";
});

Route::get('/error/except', function () {
    throw new \App\Exceptions\ValidationException('Validation error');
});

Route::get('/about/400', function () {
    abort(400, 'kamu siapa?');
});

Route::fallback(function () {
    return "404 Not Found";
});
