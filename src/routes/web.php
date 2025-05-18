<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact/confirm', [ContactController::class, 'confirm']);
Route::post('/contact/thanks', [ContactController::class, 'thanks']);
Route::get('/admin', [ContactController::class, 'admin'])->name('admin');
Route::delete('/admin/{contact}', [ContactController::class, 'destroy'])->name('admin.destroy'); // ← ここ追加！
