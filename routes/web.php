<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Default landing page goes to login
Route::get('/', [AuthController::class, 'showLoginForm']);

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Signup routes
Route::get('/signup', [AuthController::class, 'showSignupForm']);
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/tickets', [TicketController::class, 'index'])->name('tickets');
Route::post('/tickets', [TicketController::class, 'store'])->name('ticket.store');
Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('ticket.destroy');
Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('ticket.update');

Route::post('/messages/{ticket_id}', [MessageController::class, 'sendMessage'])->name('messages.send');
Route::get('/messages/{ticket_id}', [MessageController::class, 'viewMessages'])->name('messages.show');


Route::get('/admin/tickets', [AdminController::class, 'index'])->name('admin.tickets');
Route::put('/admin/tickets/{ticketId}', [AdminController::class, 'updateTicket'])->name('admin.tickets.update'); // Update ticket
