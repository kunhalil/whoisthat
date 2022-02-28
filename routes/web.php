<?php

use App\Http\Controllers\DashboardController;
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

/***
 * Default Site Routes
 */
Route::get('/', function () {
    return view('welcome');
});

/***
 * Authentication Routes
 */
require __DIR__.'/auth.php';

/***
 * Auth routes for User Token administration
 */
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/tokens/create', [DashboardController::class, 'tokenForm'])->name('tokens.form');
    Route::post('/tokens/create', [DashboardController::class, 'createToken'])->name('tokens.create');
    Route::post('/tokens/delete/{token}', [DashboardController::class, 'deleteToken'])->name('tokens.delete');
});

