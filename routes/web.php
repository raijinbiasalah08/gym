<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\TrainerController as AdminTrainerController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Trainer\DashboardController as TrainerDashboardController;
use App\Http\Controllers\Trainer\WorkoutPlanController as TrainerWorkoutPlanController;
use App\Http\Controllers\Trainer\AttendanceController as TrainerAttendanceController;
use App\Http\Controllers\Trainer\ProgressController as TrainerProgressController;
use App\Http\Controllers\Trainer\BookingController as TrainerBookingController;
use App\Http\Controllers\Trainer\ExerciseController as TrainerExerciseController;
use App\Http\Controllers\Trainer\WorkoutSplitsController as TrainerWorkoutSplitsController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\BookingController as MemberBookingController;
use App\Http\Controllers\Member\PaymentController as MemberPaymentController;
use App\Http\Controllers\Member\ProgressController as MemberProgressController;
use App\Http\Controllers\Member\ExerciseController as MemberExerciseController;
use App\Http\Controllers\Member\WorkoutSplitsController as MemberWorkoutSplitsController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Design Showcase (for development/reference)
Route::get('/design-showcase', function () {
    return view('design-showcase');
})->name('design.showcase');

// Static Pages
Route::get('/about', [App\Http\Controllers\PageController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [App\Http\Controllers\PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-service', [App\Http\Controllers\PageController::class, 'terms'])->name('terms');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

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
        Route::get('/dashboard/revenue', [AdminDashboardController::class, 'monthlyRevenue'])->name('admin.dashboard.revenue');
        
        // Members management
        Route::get('/members', [AdminMemberController::class, 'index'])->name('admin.members.index');
        Route::get('/members/create', [AdminMemberController::class, 'create'])->name('admin.members.create');
        Route::post('/members', [AdminMemberController::class, 'store'])->name('admin.members.store');
        Route::get('/members/{member}', [AdminMemberController::class, 'show'])->name('admin.members.show');
        Route::get('/members/{member}/edit', [AdminMemberController::class, 'edit'])->name('admin.members.edit');
        Route::put('/members/{member}', [AdminMemberController::class, 'update'])->name('admin.members.update');
        Route::delete('/members/{member}', [AdminMemberController::class, 'destroy'])->name('admin.members.destroy');
        Route::patch('/members/{member}/toggle-status', [AdminMemberController::class, 'toggleStatus'])->name('admin.members.toggleStatus');
        
        // Trainers management
        Route::get('/trainers', [AdminTrainerController::class, 'index'])->name('admin.trainers.index');
        Route::get('/trainers/create', [AdminTrainerController::class, 'create'])->name('admin.trainers.create');
        Route::post('/trainers', [AdminTrainerController::class, 'store'])->name('admin.trainers.store');
        Route::get('/trainers/{trainer}', [AdminTrainerController::class, 'show'])->name('admin.trainers.show');
        Route::get('/trainers/{trainer}/edit', [AdminTrainerController::class, 'edit'])->name('admin.trainers.edit');
        Route::put('/trainers/{trainer}', [AdminTrainerController::class, 'update'])->name('admin.trainers.update');
        Route::delete('/trainers/{trainer}', [AdminTrainerController::class, 'destroy'])->name('admin.trainers.destroy');
        Route::patch('/trainers/{trainer}/toggle-status', [AdminTrainerController::class, 'toggleStatus'])->name('admin.trainers.toggleStatus');
        
        // Payments management
        Route::get('/payments', [AdminPaymentController::class, 'index'])->name('admin.payments.index');
        Route::get('/payments/create', [AdminPaymentController::class, 'create'])->name('admin.payments.create');
        Route::post('/payments', [AdminPaymentController::class, 'store'])->name('admin.payments.store');
        Route::patch('/payments/{payment}/status', [AdminPaymentController::class, 'updateStatus'])->name('admin.payments.updateStatus');
        Route::delete('/payments/{payment}', [AdminPaymentController::class, 'destroy'])->name('admin.payments.destroy');
        
        // Reports
        Route::get('/reports', [AdminReportController::class, 'index'])->name('admin.reports.index');
        Route::get('/reports/financial', [AdminReportController::class, 'financialReport'])->name('admin.reports.financial');
        Route::get('/reports/financial/export', [AdminReportController::class, 'financialReportExport'])->name('admin.reports.financial.export');
        Route::get('/reports/attendance', [AdminReportController::class, 'attendanceReport'])->name('admin.reports.attendance');
        Route::get('/reports/attendance/export', [AdminReportController::class, 'attendanceReportExport'])->name('admin.reports.attendance.export');
        Route::get('/reports/membership', [AdminReportController::class, 'membershipReport'])->name('admin.reports.membership');
        Route::get('/reports/membership/export', [AdminReportController::class, 'membershipReportExport'])->name('admin.reports.membership.export');
        Route::get('/reports/trainer-performance', [AdminReportController::class, 'trainerPerformanceReport'])->name('admin.reports.trainer-performance');
        Route::get('/reports/trainer-performance/export', [AdminReportController::class, 'trainerPerformanceExport'])->name('admin.reports.trainer-performance.export');
        Route::get('/reports/booking-analytics', [AdminReportController::class, 'bookingAnalyticsReport'])->name('admin.reports.booking-analytics');
        Route::get('/reports/booking-analytics/export', [AdminReportController::class, 'bookingAnalyticsExport'])->name('admin.reports.booking-analytics.export');
        Route::get('/reports/progress-tracking', [AdminReportController::class, 'progressTrackingReport'])->name('admin.reports.progress-tracking');
        Route::get('/reports/progress-tracking/export', [AdminReportController::class, 'progressTrackingExport'])->name('admin.reports.progress-tracking.export');
        Route::get('/reports/class-utilization', [AdminReportController::class, 'classUtilizationReport'])->name('admin.reports.class-utilization');
        Route::get('/reports/class-utilization/export', [AdminReportController::class, 'classUtilizationExport'])->name('admin.reports.class-utilization.export');
        Route::get('/reports/revenue-by-trainer', [AdminReportController::class, 'revenueByTrainerReport'])->name('admin.reports.revenue-by-trainer');
        Route::get('/reports/revenue-by-trainer/export', [AdminReportController::class, 'revenueByTrainerExport'])->name('admin.reports.revenue-by-trainer.export');
        Route::get('/reports/member-retention', [AdminReportController::class, 'memberRetentionReport'])->name('admin.reports.member-retention');
        Route::get('/reports/member-retention/export', [AdminReportController::class, 'memberRetentionExport'])->name('admin.reports.member-retention.export');
        Route::get('/reports/upcoming-expirations', [AdminReportController::class, 'upcomingExpirationsReport'])->name('admin.reports.upcoming-expirations');
        Route::get('/reports/upcoming-expirations/export', [AdminReportController::class, 'upcomingExpirationsExport'])->name('admin.reports.upcoming-expirations.export');
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
        
        // Bookings
        Route::get('/bookings', [TrainerBookingController::class, 'index'])->name('trainer.bookings.index');
        Route::get('/bookings/{booking}', [TrainerBookingController::class, 'show'])->name('trainer.bookings.show');
        Route::get('/bookings/calendar', [TrainerBookingController::class, 'calendar'])->name('trainer.bookings.calendar');
        Route::patch('/bookings/{booking}/status', [TrainerBookingController::class, 'updateStatus'])->name('trainer.bookings.update-status');
        
        // Progress Tracking
        Route::resource('progress', TrainerProgressController::class)->names('trainer.progress');
        
        // Exercise Details
        Route::get('/exercises/{slug}', [TrainerExerciseController::class, 'show'])->name('trainer.exercises.show');
        
        // Workout Splits Guide
        Route::get('/workout-splits', [TrainerWorkoutSplitsController::class, 'index'])->name('trainer.workout-splits.index');
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
        // Attendance (member view)
        Route::get('/attendance', [MemberDashboardController::class, 'attendanceIndex'])->name('member.attendance.index');
        Route::get('/attendance/export', [MemberDashboardController::class, 'attendanceExport'])->name('member.attendance.export');
        
        // Membership page
        Route::get('/membership', [MemberDashboardController::class, 'membershipPage'])->name('member.membership');
        Route::post('/membership/update', [MemberDashboardController::class, 'updateMembership'])->name('member.membership.update');


        // Payments
        Route::get('/payments', [MemberPaymentController::class, 'index'])->name('member.payments.index');
        Route::get('/payments/history', [MemberPaymentController::class, 'paymentHistory'])->name('member.payments.history');
        
        // Exercise Library
        Route::get('/exercises', [MemberExerciseController::class, 'index'])->name('member.exercises.index');
        Route::get('/exercises/{slug}', [MemberExerciseController::class, 'show'])->name('member.exercises.show');
        
        // Workout Splits Guide
        Route::get('/workout-splits', [MemberWorkoutSplitsController::class, 'index'])->name('member.workout-splits.index');
    });
});