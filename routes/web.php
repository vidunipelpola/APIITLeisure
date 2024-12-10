<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    if (Auth::check()) {
        // If the user is authenticated, redirect them to the dashboard
        return redirect()->route('dashboard');
    } else {
        // If the user is not authenticated, show the login page
        return redirect()->route('login');
    }
    
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    return view('dashboard', ['sports' => $user->sport_interest]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/leave-sport', [ProfileController::class, 'leaveSport'])->name('leave-sport');
    Route::post('/join-sport', [ProfileController::class, 'joinSport'])->name('join-sport');
});

require __DIR__.'/auth.php';

Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

// Chat Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/chat/{sport}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{sport}/message', [ChatController::class, 'sendMessage'])->name('chat.message');
    Route::delete('/chat/message/{message}', [ChatController::class, 'deleteMessage'])->name('chat.delete');
});

// Notification Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/unread', [NotificationController::class, 'unread'])->name('notifications.unread');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount']);
});
