<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    
    Route::middleware('auth:sanctum')->group(function () {

        Route::prefix('/profile')->group(function () {
            Route::get('/', 'profile');
            Route::post('/', 'update');
        });
        Route::get('/user', [AuthController::class, 'me'])->middleware('auth:sanctum');

        Route::post('/logout', 'logout');
    });

});

Route::apiResource('/ahliwaris', App\Http\Controllers\AhliwarisController::class);
Route::apiResource('/datameninggal', App\Http\Controllers\AlmController::class);
Route::apiResource('/meninggal', App\Http\Controllers\MeninggalController::class);
Route::apiResource('/pemakaman', App\Http\Controllers\PemakamanController::class);
Route::apiResource('/blok', App\Http\Controllers\BlokController::class);
Route::apiResource('/heregistrasi', App\Http\Controllers\HeregistrasiController::class);

Route::get('/', function () {
    return view('welcome');
})->name('home');
