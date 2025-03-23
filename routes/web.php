<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Default landing page goes to login
Route::get('/', [AuthController::class, 'showLoginForm']);

// --------------------------
// Authentication Routes
// --------------------------
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/signup', [AuthController::class, 'showSignupForm']);
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');


// --------------------------
// Dashboard Routes
// --------------------------
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// --------------------------
// Ticket Routes
// --------------------------

Route::get('/tickets', [TicketController::class, 'index'])->name('tickets');
Route::post('/tickets', [TicketController::class, 'store'])->name('ticket.store');
Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('ticket.destroy');
Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('ticket.update');
// --------------------------
// Message Routes
// --------------------------
Route::post('/messages/{ticket_id}', [MessageController::class, 'sendMessage'])->name('messages.send');
Route::get('/messages/{ticket_id}', [MessageController::class, 'viewMessages'])->name('messages.show');

// --------------------------
// Admin Routes
// --------------------------
Route::get('/admin/tickets', [AdminController::class, 'index'])->name('admin.tickets');
Route::put('/admin/tickets/{ticketId}', [AdminController::class, 'updateTicket'])->name('admin.tickets.update');
Route::get('/admin/messages', [MessageController::class, 'index'])->name('messages.index');

// --------------------------
// Chat Routes
// --------------------------
Route::get('/chat/{ticket_id}', [MessageController::class, 'showChat'])->name('chat.show');

// --------------------------
// 404 Route (For Undefined Routes)
// --------------------------

Route::fallback(function () {
    return view('404'); // You can return the custom 404 view you created earlier.
});
