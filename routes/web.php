<?php

use App\Http\Controllers\CityRatingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReportController;
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

    Route::post('/questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');
    Route::patch('/questions/{question}/answers/{answer}/most-helpful', [AnswerController::class, 'markMostHelpful'])
        ->name('answers.markMostHelpful');
    Route::post('/vote/{type}/{id}', [VoteController::class, 'store'])->name('vote.store');

    //s4
    //chat
    Route::get('/messages',[MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user}',[MessageController::class, 'store'])->name('messages.store');
    //city rating
    Route::post('/cities/{city}/rate', [CityRatingController::class, 'store'])->name('cities.rate');
    //report
    Route::post('/report/{type}/{id}', [ReportController::class, 'store'])->name('report.store');
    //
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::resource('countries', CountryController::class);
    Route::resource('admin/cities', CityController::class)
        ->names('admin.cities')
        ->except(['show']);
    //s4 admin control over reports
    Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])  ->name('reports.index');
    Route::patch('/reports/{report}/approve', [\App\Http\Controllers\Admin\ReportController::class, 'approve'])->name('reports.approve');
    Route::patch('/reports/{report}/remove',[\App\Http\Controllers\Admin\ReportController::class, 'remove']) ->name('reports.remove');
    //
});
});

require __DIR__.'/auth.php';
