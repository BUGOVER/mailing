<?php

declare(strict_types=1);

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

Route::middleware(['guest'])->namespace('App\Http\Controllers')->group(
    function () {
        Route::get('/', 'Controller@index')->name('index');
        Route::post('login', 'Controller@login')->middleware(['assign.guard:admin'])->name('login');
    }
);

Route::middleware([/*'auth:admin'*/])->namespace('App\Http\Controllers')->prefix('mailings')->group(
    function () {
        Route::get('/', 'Controller@mailingIndex')->name('index_mailing');
        Route::post('add_user', 'Controller@addUser')->name('add_user');
        Route::get('/{any}', 'Controller@mailingIndex')->where('any', '.*');
    }
);
