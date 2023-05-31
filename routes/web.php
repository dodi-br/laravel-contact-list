<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\LoginController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::redirect('/', '/contacts');

Route::resource('contacts', ContactsController::class);

Route::get(
    '/archived_contacts/list',
    [ContactsController::class, 'archived']
)->name('archived_contacts.list');

Route::put(
    '/archived_contacts/{contact}/restore',
    [ContactsController::class, 'restore']
)->name('archived_contacts.restore');

Route::group(['middleware' => ['auth']], function() {
    Route::get(
        '/logout',
        [LoginController::class, 'logout']
    )->name('logout.do');
});

Route::get(
    '/login',
    [LoginController::class, 'show']
)->name('login.show');

Route::get(
    '/login',
    [LoginController::class, 'show']
)->name('login');

Route::post(
    '/login',
    [LoginController::class, 'login']
)->name('login.do');