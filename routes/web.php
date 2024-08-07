<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserDesignationController;
use App\Http\Controllers\UserController;

Route::middleware(['redirect-if-authenticated'])->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth:admin', 'prevent-back-history'])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('admin/user_designation', [UserDesignationController::class, 'index'])->name('admin.user_designation');
    Route::post('admin/user_designation', [UserDesignationController::class, 'submit_data'])->name('admin.user_designation.post');
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    // Display the form for editing the user
    Route::get('admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    // Toggle user status
    Route::get('admin/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('admin.users.toggleStatus');


});

Route::middleware(['auth:user', 'prevent-back-history'])->group(function () {
    Route::get('user/dashboard', function () {
        return view('user.dashboard');
    });
});

Route::get('/', function () {
    return view('welcome');
});
