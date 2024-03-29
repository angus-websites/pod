<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\FeedbackController;
use \App\Http\Controllers\CVController;

use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [HomeController::class, 'welcome'])->name('index');


/**
 * Sanctum middleware routes
 */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::resource('entries', EntryController::class);

    // Feedback routes
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
    Route::get('/feedback/review', [FeedbackController::class, 'review'])->name('feedback.review');
    Route::post('/feedback/submit', [FeedbackController::class, 'submit'])->name('feedback.submit');

    // CV Routes
    Route::get('/cv', [CVController::class, 'index'])->name('cv');
    Route::get('/cv/download', [CVController::class, 'createPDF'])->name('cv.download');

});


