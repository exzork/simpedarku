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
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard-old');

Route::get('/user/profile', [\App\Http\Controllers\UserProfile::class,'index'])->middleware(['auth'])->name('user.profile');


require __DIR__ . '/admin.php';
require __DIR__ . '/stakeholder.php';
require __DIR__ . '/auth.php';
