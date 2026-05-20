<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TicketCommentController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tickets.index');
});

Route::get('/dashboard', function () {
    return redirect()->route('tickets.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('tickets', TicketController::class);
    Route::patch('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])
        ->name('tickets.updateStatus')
        ->middleware('role:admin,support');

    Route::post('/tickets/{ticket}/comments', [TicketCommentController::class, 'store'])
        ->name('tickets.comments.store')
        ->middleware('role:admin,support');

    Route::resource('categories', CategoryController::class)
        ->middleware('role:admin');

    Route::get('/reports/active-tickets', [ReportController::class, 'activeTickets'])
        ->name('reports.activeTickets')
        ->middleware('role:admin,support');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
