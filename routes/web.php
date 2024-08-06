<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('forms.save-form');
});

Route::post('/save' , [FileController::class , 'save'])->name('save.text');
Route::get('/{file_path}' , [FileController::class , 'get'])->name('get.text');

// Route::get('delete/{file_path}' , [FileController::class , 'delete']);
