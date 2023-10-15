<?php

use App\Http\Controllers\FinishReasonController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ReasonController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UserController;
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

Route::get('/',[SiteController::class, 'index']);

Auth::routes();

Route::get('/prosecutors', [SiteController::class, 'prosecutors'])->name('prosecutors');

Route::middleware('auth')->group(function () {
    Route::get('roles', [RoleController::class, 'index']);
    Route::resource('users', UserController::class)->names('users');
    Route::resource('offices', OfficeController::class)->names('offices');
    Route::resource('people', PeopleController::class)->names('people');
    Route::resource('reasons', ReasonController::class)->names('reasons');
    Route::resource('finish-reasons', FinishReasonController::class)->names('finish-reasons');
    Route::resource('tickets', TicketsController::class)->names('tickets');
    Route::get('attention', [TicketsController::class, 'attention'])->name('tickets.attention');
});