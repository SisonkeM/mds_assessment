<?php

use App\Http\Controllers\holidaysController;
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

Route::get('/', [holidaysController::class, 'index']);
Route::post('/downloadDocument', [holidaysController::class, 'download_document']);
Route::get('/getPublicHolidays', [holidaysController::class, 'get_public_holidays']);

