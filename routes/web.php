<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\TrainerController as AdminTrainerController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Trainer\DashboardController as TrainerDashboardController;
use App\Http\Controllers\Trainer\WorkoutPlanController as TrainerWorkoutPlanController;
use App\Http\Controllers\Trainer\AttendanceController as TrainerAttendanceController;
use App\Http\Controllers\Trainer\ProgressController as TrainerProgressController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\BookingController as MemberBookingController;
use App\Http\Controllers\Member\PaymentController as MemberPaymentController;
use App\Http\Controllers\Member\ProgressController as MemberProgressController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {
    // Dashboard redirect based on role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        return match($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'trainer' => redirect()->route('trainer.dashboard'),
            'member' => redirect()->route('member.dashboard'),
            default => redirect()->route('home'),
        };
    })->name('dashboard');

    // Admin routes
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        
        // Members management
        Route::get('/members', [AdminMemberController::class, 'index'])->name('admin.members.index');
        Route::get('/members/create', [AdminMemberController::class, 'create'])->name('admin.members.create');
        Route::post('/members', [AdminMemberController::class, 'store'])->name('admin.members.store');
        Route::get('/members/{member}', [AdminMemberController::class, 'show'])->name('admin.members.show');
        Route::get('/members/{member}/edit', [AdminMemberController::class, 'edit'])->name('admin.members.edit');
        Route::put('/members/{member}', [AdminMemberController::class, 'update'])->name('admin.members.update');
        Route::delete('/members/{member}', [AdminMemberController::class, 'destroy'])->name('admin.members.destroy');
        
        // Trainers management
        Route::get('/trainers', [AdminTrainerController::class, 'index'])->name('admin.trainers.index');
        Route::get('/trainers/create', [AdminTrainerController::class, 'create'])->name('admin.trainers.create');
        Route::post('/trainers', [AdminTrainerController::class, 'store'])->name('admin.trainers.store');
        Route::get('/trainers/{trainer}', [AdminTrainerController::class, 'show'])->name('admin.trainers.show');
        Route::get('/trainers/{trainer}/edit', [AdminTrainerController::class, 'edit'])->name('admin.trainers.edit');
        Route::put('/trainers/{trainer}', [AdminTrainerController::class, 'update'])->name('admin.trainers.update');
        Route::delete('/trainers/{trainer}', [AdminTrainerController::class, 'destroy'])->name('admin.trainers.destroy');
        
        // Payments management
        Route::get('/payments', [AdminPaymentController::class, 'index'])->name('admin.payments.index');
        Route::get('/payments/create', [AdminPaymentController::class, 'create'])->name('admin.payments.create');
        Route::post('/payments', [AdminPaymentController::class, 'store'])->name('admin.payments.store');
        Route::patch('/payments/{payment}/status', [AdminPaymentController::class, 'updateStatus'])->name('admin.payments.updateStatus');
        Route::delete('/payments/{payment}', [AdminPaymentController::class, 'destroy'])->name('admin.payments.destroy');
    });

    // Trainer routes
    Route::prefix('trainer')->group(function () {
        Route::get('/dashboard', [TrainerDashboardController::class, 'index'])->name('trainer.dashboard');
        
        // Workout plans
        Route::get('/workout-plans', [TrainerWorkoutPlanController::class, 'index'])->name('trainer.workout-plans.index');
        Route::get('/workout-plans/create', [TrainerWorkoutPlanController::class, 'create'])->name('trainer.workout-plans.create');
        Route::post('/workout-plans', [TrainerWorkoutPlanController::class, 'store'])->name('trainer.workout-plans.store');
        Route::get('/workout-plans/{workoutPlan}', [TrainerWorkoutPlanController::class, 'show'])->name('trainer.workout-plans.show');
        
        // Attendance
        Route::get('/attendance', [TrainerAttendanceController::class, 'index'])->name('trainer.attendance.index');
        Route::get('/attendance/create', [TrainerAttendanceController::class, 'create'])->name('trainer.attendance.create');
        Route::post('/attendance', [TrainerAttendanceController::class, 'store'])->name('trainer.attendance.store');
    });

    // Member routes
    Route::prefix('member')->group(function () {
        Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('member.dashboard');
        
        // Bookings
        Route::get('/bookings', [MemberBookingController::class, 'index'])->name('member.bookings.index');
        Route::get('/bookings/create', [MemberBookingController::class, 'create'])->name('member.bookings.create');
        Route::post('/bookings', [MemberBookingController::class, 'store'])->name('member.bookings.store');
        Route::get('/bookings/{booking}', [MemberBookingController::class, 'show'])->name('member.bookings.show');
        Route::patch('/bookings/{booking}/cancel', [MemberBookingController::class, 'cancel'])->name('member.bookings.cancel');
        
        // Progress
        Route::get('/progress', [MemberProgressController::class, 'index'])->name('member.progress.index');
        Route::get('/progress/{progress}', [MemberProgressController::class, 'show'])->name('member.progress.show');
    });
});