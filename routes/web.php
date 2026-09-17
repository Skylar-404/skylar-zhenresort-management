<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FolioController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Home;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;

// ==========================================
// CLIENT WEBSITE ROUTES (Public & Free to View)
// ==========================================
Route::get('/', [Home::class, 'form'])->name('home');
Route::get('/home', [Home::class, 'form'])->name('website.home');
Route::get('/website', [Home::class, 'form'])->name('website');

// ==========================================
// PUBLIC AUTHENTICATION ROUTES (Admin / Staff)
// ==========================================
// Public Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==========================================
// PROTECTED ADMIN PORTAL (Sidebar Modules)
// ==========================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Global Search
    Route::get('/search', [SearchController::class, 'index'])->name('search');

    // 1. Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Reservations
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations');
    Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    // 3. Guests
    Route::get('/guests', [GuestController::class, 'index'])->name('guests');
    Route::post('/guests', [GuestController::class, 'store'])->name('guests.store');
    Route::put('/guests/{id}', [GuestController::class, 'update'])->name('guests.update');
    Route::delete('/guests/{id}', [GuestController::class, 'destroy'])->name('guests.destroy');

    // 4. Folios & Line Charges
    Route::get('/folios', [FolioController::class, 'index'])->name('folios');
    Route::post('/folios', [FolioController::class, 'store'])->name('folios.store');
    Route::put('/folios/{id}', [FolioController::class, 'update'])->name('folios.update');
    Route::delete('/folios/{id}', [FolioController::class, 'destroy'])->name('folios.destroy');
    Route::post('/folios/{id}/charges', [FolioController::class, 'storeCharge'])->name('folios.charges.store');
    Route::put('/folios/charges/{id}/void', [FolioController::class, 'voidCharge'])->name('folios.charges.void');

    // 5. Invoices & Payments
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::put('/invoices/{id}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('/invoices/{id}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
    Route::post('/invoices/{id}/payments', [InvoiceController::class, 'storePayment'])->name('invoices.payments.store');

    // 6. Room Routes
    Route::get('/room', [RoomController::class, 'index'])->name('rooms');
    Route::get('/property', [RoomController::class, 'index'])->name('property');
    Route::post('/room', [RoomController::class, 'store'])->name('rooms.store');
    Route::put('/room/{id}', [RoomController::class, 'update'])->name('rooms.update');
    Route::put('/rooms/{id}', [RoomController::class, 'update']);
    Route::patch('/room/{id}/status', [RoomController::class, 'updateStatus'])->name('rooms.status.update');
    Route::patch('/rooms/{id}/status', [RoomController::class, 'updateStatus']);
    Route::delete('/room/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);

    // 7. Maintenance Work Orders
    Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance');
    Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');
    Route::put('/maintenance/{id}', [MaintenanceController::class, 'update'])->name('maintenance.update');
    Route::delete('/maintenance/{id}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');

    // 8. Users (Staff & Admin Accounts)
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // 9. Experiences & Concierge Services
    Route::get('/services', fn() => view('admin.services'))->name('services');
    Route::get('/service', fn() => view('admin.services'));
});
