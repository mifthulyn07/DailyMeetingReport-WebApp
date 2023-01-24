<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ManagementReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/sign-in', function () {
    return view('pages.sign-in');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::middleware('role:super-admin,staff')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/employees', [UserController::class, 'index'])->name('employees.index');
        Route::get('/employees/print', [UserController::class, 'print'])->name('employees.print');
        
        Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::get('/attendance/printAll', [AttendanceController::class, 'printAll'])->name('attendance.printAll');
        Route::get('/attendance/printWeek', [AttendanceController::class, 'printWeek'])->name('attendance.printWeek');
        Route::get('/attendance/printMonth', [AttendanceController::class, 'printMonth'])->name('attendance.printMonth');
        Route::get('/attendance/printYear', [AttendanceController::class, 'printYear'])->name('attendance.printYear');
        Route::post('/attendance', [AttendanceController::class, 'clockin'])->name('attendance.clockin');
        Route::put('/attendance/{id}', [AttendanceController::class, 'clockout'])->name('attendance.clockout');
    });

    Route::middleware('role:super-admin')->group(function () {
        Route::post('/employees', [UserController::class, 'store'])->name('employees.store');
        Route::get('/employees/{id}', [UserController::class, 'show'])->name('employees.show');
        Route::put('/employees/{id}', [UserController::class, 'update'])->name('employees.update');
        Route::delete('/employees/{id}', [UserController::class, 'destroy'])->name('employees.destroy');
        
        Route::get('/managementReport', [ManagementReportController::class, 'index'])->name('managementReport.index');
        Route::get('/managementReport/printAll', [ManagementReportController::class, 'printAll'])->name('managementReport.printAll');
        Route::post('/managementReport', [ManagementReportController::class, 'store'])->name('managementReport.store');
        Route::get('/managementReport/{id}', [ManagementReportController::class, 'show'])->name('managementReport.show');
        Route::put('/managementReport/{id}', [ManagementReportController::class, 'update'])->name('managementReport.update');
        Route::delete('/managementReport/{id}', [ManagementReportController::class, 'destroy'])->name('managementReport.destroy');
    });
});

