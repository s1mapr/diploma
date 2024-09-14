<?php

use App\Http\Controllers\Web as Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/docs')->name('docs.')->controller(Controllers\DocsController::class)->group(function () {
    Route::get('/', 'getDocs')->name('index');
});
