<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MestoController;
use App\Http\Controllers\OborController;
use App\Http\Controllers\PocetController;
use App\Http\Controllers\SkolaController;

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

// Frontend
Route::get('/', [MapController::class, 'index'])->name('index');
Route::get('/filter', [MapController::class, 'filter'])->name('index.filter'); // Filtered results

// Auth
Auth::routes();

// Admin
Route::get('admin', [HomeController::class, 'index'])->name('admin');

Route::resources([
    'admin/pocet' => PocetController::class,
    'admin/obor' => OborController::class,
    'admin/skola' => SkolaController::class,
    'admin/mesto' => MestoController::class,
]);
