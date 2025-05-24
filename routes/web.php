<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('contacts/import-files', [ContactController::class, 'index']);
Route::post('contacts/import-files/xml', [ContactController::class, 'store'])->name('contacts.importfile.xml');