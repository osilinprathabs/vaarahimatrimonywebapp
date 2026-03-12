<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/subcastes/{caste_id}', function ($caste_id) {
    return \App\Models\Subcaste::where('caste_id', $caste_id)->get();
});

Route::get('/stars/{raasi_id}', function ($raasi_id) {
    return \App\Models\Star::where('raasi_id', $raasi_id)->get();
});

