<?php

use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'role:admin,user']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
});
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect(route('login.form'));
})->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('users', [UserManagementController::class, 'index'])->name('users.index');
    Route::get('users/{uuid}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
    Route::put('users/{uuid}', [UserManagementController::class, 'update'])->name('users.update');
    Route::post('users/{uuid}/toggle', [UserManagementController::class, 'toggleStatus'])->name('users.toggle');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('account')->group(function () {
        Route::get('/', [AccountSettingsController::class, 'index'])->name('account.index');
        Route::put('profile', [AccountSettingsController::class, 'updateProfile'])->name('account.profile.update');
        Route::put('password', [AccountSettingsController::class, 'updatePassword'])->name('account.password.update');
    });

    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/{id}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    });
});
