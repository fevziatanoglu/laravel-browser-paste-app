<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
});

Route::post('/delete' , [FileController::class , 'delete'])->name('delete.text');
Route::post('/save' , [FileController::class , 'save'])->name('save.text');
Route::get('/get' , [FileController::class , 'get'])->name('get.text');
