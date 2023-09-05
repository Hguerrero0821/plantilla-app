<?php

use App\Http\Controllers\auditingController;
use App\Http\Controllers\menuController;
use App\Http\Controllers\notificationController;
use App\Http\Controllers\rolesController;
use App\Http\Controllers\userController;
use App\Models\User;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['roles'])->group( function() {
    Route::resource('usuarios',userController::class);
    Route::resource('menus',menuController::class);
    Route::resource('roles',rolesController::class);
    Route::resource('auditorias', auditingController::class);

});


Route::resource('notification',notificationController::class);

Route::get('fecha',[notificationController::class,'fecha'])->name('fecha');

Auth::routes();
