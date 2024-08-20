<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserDesignationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProjectMessageController;
use App\Http\Controllers\NotificationController;

Route::middleware(['redirect-if-authenticated'])->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// ============  Admin Panel Start  =========
Route::middleware(['auth:admin', 'prevent-back-history'])->group(function () {

    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    });

    // ============  User Handler =========
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('admin/users', [UserController::class, 'store'])->name('user.store');
    Route::get('admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::get('admin/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('admin.users.toggleStatus');
    // ============  User Handler Ends =========


    // ============  Designations Handler =========
    Route::get('admin/user_designation', [UserDesignationController::class, 'index'])->name('admin.user_designation');
    Route::post('admin/user_designation', [UserDesignationController::class, 'submit_data'])->name('admin.user_designation.post');
    Route::get('admin/user_designation/{id}/edit', [UserDesignationController::class, 'edit'])->name('admin.user_designation.edit');
    Route::put('admin/user_designation/{id}', [UserDesignationController::class, 'update'])->name('admin.user_designation.update');
    Route::get('admin/user_designation/{id}/toggle-status', [UserDesignationController::class, 'toggleStatus'])->name('admin.user_designation.toggleStatus');
    // ============  Designations Handler Ends =========


    // ============  Services Handler =========
    Route::get('admin/project_services', [ServiceController::class, 'index'])->name('admin.project_services');
    Route::post('admin/project_services', [ServiceController::class, 'submit_data'])->name('admin.project_services.post');
    Route::get('admin/project_services/{id}/edit', [ServiceController::class, 'edit'])->name('admin.project_services.edit');
    Route::put('admin/project_services/{id}', [ServiceController::class, 'update'])->name('admin.project_services.update');
    Route::get('admin/project_services/{id}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('admin.project_services.toggleStatus');
    // ============  Services Handler Ends =========

    // ============  Projects Handler ========= 
    Route::get('admin/projects', [ProjectController::class, 'index'])->name('admin.projects');
    Route::get('admin/add_projects', [ProjectController::class, 'add_projects'])->name('admin.add_projects');
    Route::post('admin/add_projects', [ProjectController::class, 'save_project'])->name('admin.add_project.post');
    Route::get('admin/project_details/{id}', [ProjectController::class, 'project_details'])->name('admin_project.details');
    // ============  Projects Handler End========= 



    // ============  Message and Notifications Handler ========= 
    Route::post('add_message_admin', [ProjectMessageController::class, 'store'])->name('add_message_admin');
    Route::get('fetch_messages_admin', [ProjectMessageController::class, 'fetchMessages'])->name('fetch_messages_admin');
    Route::get('unread_count_admin', [NotificationController::class, 'unreadCount'])->name('unread_count_admin');
    Route::get('notifications_admin', [NotificationController::class, 'getNotifications'])->name('notifications_admin');
    Route::post('notifications_admin/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications_admin.mark-all-as-read');
    // ============  Message and Notifications Handler Ends========= 


});

// ============  Admin Panel End  =========


// ============  User Panel Start  =========
Route::middleware(['auth:user', 'prevent-back-history'])->group(function () {
    Route::get('user/dashboard', function () {
        return view('user.dashboard');
    });


     // ============  Projects Handler ========= 
     Route::get('user/all_projects', [ProjectController::class, 'user_all_projects'])->name('user.all_projects');
     Route::get('user/project_details/{id}', [ProjectController::class, 'user_project_details'])->name('user.project_details');
     // ============  Projects Handler End========= 
 

    // ============  Message and Notifications Handler ========= 
    Route::post('add_message_user', [ProjectMessageController::class, 'user_store'])->name('add_message_user');
    Route::get('fetch_messages_user', [ProjectMessageController::class, 'fetchMessages'])->name('fetch_messages_user');
    Route::get('unread_count_user', [NotificationController::class, 'unreadCount_user'])->name('unread_count_user');
    Route::get('notifications_user', [NotificationController::class, 'getNotifications_user'])->name('notifications_user');
    Route::post('notifications_user/mark-all-as-read', [NotificationController::class, 'markAllAsRead_user'])->name('notifications_user.mark-all-as-read');
    // ============  Message and Notifications Handler Ends========= 


});








// ============  User Panel End  =========

Route::get('/', function () {
    return view('welcome');
});
