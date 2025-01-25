<?php

use App\Http\Controllers\PageController;
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

Route::get('/' , [PageController::class , 'register'])->name('register');
Route::get('/login' , [PageController::class , 'login'])->name('login');
Route::get('/forget/password' , [PageController::class , 'forgetPassword'])->name('forget.password');
Route::get('/dashboard' , [PageController::class , 'dashboard'])->name('dashboard');
Route::get('/servers' , [PageController::class , 'server'])->name('server');
Route::get('/server/template' , [PageController::class , 'serverTemplate'])->name('template');
Route::get('/server/os' , [PageController::class , 'serverOperatingSystem'])->name('operating.system');
Route::get('/regions' , [PageController::class , 'region'])->name('region');
Route::get('/credit' , [PageController::class , 'credit'])->name('credit');