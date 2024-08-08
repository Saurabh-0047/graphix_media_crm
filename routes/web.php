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


    // ============  Admin Panel Start  =========
    Route::middleware(['auth:admin', 'prevent-back-history'])->group(function () {
    
    Route::get('admin/dashboard', function () {return view('admin.dashboard');});
    
    // ============  User Handler =========
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('admin/users', [UserController::class, 'store'])->name('user.store');
    Route::get('admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::get('admin/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('admin.users.toggleStatus');

    // ============  Designations Handler =========
    Route::get('admin/user_designation', [UserDesignationController::class, 'index'])->name('admin.user_designation');
    Route::post('admin/user_designation', [UserDesignationController::class, 'submit_data'])->name('admin.user_designation.post');
    Route::get('admin/user_designation/{id}/edit', [UserDesignationController::class, 'edit'])->name('admin.user_designation.edit');
    Route::put('admin/user_designation/{id}', [UserDesignationController::class, 'update'])->name('admin.user_designation.update');
    Route::get('admin/user_designation/{id}/toggle-status', [UserDesignationController::class, 'toggleStatus'])->name('admin.user_designation.toggleStatus');

});

    // ============  Admin Panel End  =========

Route::middleware(['auth:user', 'prevent-back-history'])->group(function () {
    Route::get('user/dashboard', function () {
        return view('user.dashboard');
    });
});

Route::get('/', function () {
    return view('welcome');
});
