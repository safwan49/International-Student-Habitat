<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

// Public city pages
Route::get('/cities', [CityController::class, 'publicIndex'])->name('cities.public');
Route::get('/cities/{city}', [CityController::class, 'show'])->name('cities.show');

Route::middleware(['auth','verified'])->group(function () {
    Route::resource('experiences', ExperienceController::class);
    Route::resource('questions', QuestionController::class);
    Route::get('/questions/{question}/answers',
    [AnswerController::class, 'index'])->name('answers.index');

    Route::post('/questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');
    Route::post('/questions/{question}/answers/{answer}/mark-most-helpful',
    [AnswerController::class, 'markMostHelpful'])->name('answers.markMostHelpful');
    Route::post('/vote/{type}/{id}', [VoteController::class, 'store'])->name('vote.store');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::resource('countries', CountryController::class);

    Route::resource('admin/cities', CityController::class)
        ->names('admin.cities')
        ->except(['show']);
});

require __DIR__.'/auth.php';
