@extends('layouts.app')

@section('title', 'Reports - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Reports & Analytics</h1>
                <p class="text-sm text-gray-600 mt-1">Comprehensive insights into your gym's performance</p>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            <div class="glass-card overflow-hidden rounded-xl transition hover:shadow-lg group">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-xl bg-gradient-to-br from-green-500 to-green-600 p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-money-bill-wave text-2xl text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-600 truncate">Monthly Revenue</dt>
                                <dd class="text-lg font-bold text-gray-900 mt-1">
                                    ${{ number_format(\App\Models\Payment::paid()->whereMonth('payment_date', now()->month)->sum('amount'), 2) }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card overflow-hidden rounded-xl transition hover:shadow-lg group">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-users text-2xl text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-600 truncate">New Members</dt>
                                <dd class="text-lg font-bold text-gray-900 mt-1">
                                    {{ \App\Models\User::members()->whereMonth('created_at', now()->month)->count() }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card overflow-hidden rounded-xl transition hover:shadow-lg group">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-clipboard-check text-2xl text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-600 truncate">Today's Attendance</dt>
                                <dd class="text-lg font-bold text-gray-900 mt-1">
                                    {{ \App\Models\Attendance::whereDate('date', today())->count() }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card overflow-hidden rounded-xl transition hover:shadow-lg group">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-exclamation-triangle text-2xl text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-600 truncate">Expiring Soon</dt>
                                <dd class="text-lg font-bold text-gray-900 mt-1">
                                    {{ \App\Models\User::members()->expiringSoon(7)->count() }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Report Cards -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            <!-- Financial Report Card -->
            <div class="glass-card rounded-xl p-6 hover:shadow-xl transition duration-300">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-3 shadow-md">
                        <i class="fas fa-chart-line text-xl text-white"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-900">Financial Report</h3>
                        <p class="text-sm text-gray-600">Revenue and payment analytics</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.reports.financial') }}" class="block w-full text-center px-4 py-2 bg-white bg-opacity-50 hover:bg-opacity-80 text-gray-800 font-medium rounded-lg transition border border-gray-200">
                        <i class="fas fa-file-invoice-dollar mr-2 text-green-600"></i>Generate Report
                    </a>
                </div>
            </div>

            <!-- Attendance Report Card -->
            <div class="glass-card rounded-xl p-6 hover:shadow-xl transition duration-300">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-3 shadow-md">
                        <i class="fas fa-clipboard-list text-xl text-white"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-900">Attendance Report</h3>
                        <p class="text-sm text-gray-600">Member visit patterns</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.reports.attendance') }}" class="block w-full text-center px-4 py-2 bg-white bg-opacity-50 hover:bg-opacity-80 text-gray-800 font-medium rounded-lg transition border border-gray-200">
                        <i class="fas fa-calendar-check mr-2 text-blue-600"></i>Generate Report
                    </a>
                </div>
            </div>

            <!-- Membership Report Card -->
            <div class="glass-card rounded-xl p-6 hover:shadow-xl transition duration-300">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-3 shadow-md">
                        <i class="fas fa-users text-xl text-white"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-900">Membership Report</h3>
                        <p class="text-sm text-gray-600">Growth and retention stats</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.reports.membership') }}" class="block w-full text-center px-4 py-2 bg-white bg-opacity-50 hover:bg-opacity-80 text-gray-800 font-medium rounded-lg transition border border-gray-200">
                        <i class="fas fa-chart-pie mr-2 text-purple-600"></i>Generate Report
                    </a>
                </div>
            </div>

            <!-- Trainer Performance Report Card -->
            <div class="glass-card rounded-xl p-6 hover:shadow-xl transition duration-300">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg p-3 shadow-md">
                        <i class="fas fa-dumbbell text-xl text-white"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-900">Trainer Performance</h3>
                        <p class="text-sm text-gray-600">Session and client metrics</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.reports.trainer-performance') }}" class="block w-full text-center px-4 py-2 bg-white bg-opacity-50 hover:bg-opacity-80 text-gray-800 font-medium rounded-lg transition border border-gray-200">
                        <i class="fas fa-star mr-2 text-orange-600"></i>Generate Report
                    </a>
                </div>
            </div>

            <!-- Booking Report Card -->
            <div class="glass-card rounded-xl p-6 hover:shadow-xl transition duration-300">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0 bg-gradient-to-br from-red-500 to-red-600 rounded-lg p-3 shadow-md">
                        <i class="fas fa-calendar-alt text-xl text-white"></i>
                    </div>
                    <div class="flex-shrink-0 bg-gradient-to-br from-teal-500 to-teal-600 rounded-lg p-3 shadow-md">
                        <i class="fas fa-users-cog text-xl text-white"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-900">Class Utilization</h3>
                        <p class="text-sm text-gray-600">Popular classes and times</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.reports.class-utilization') }}" class="block w-full text-center px-4 py-2 bg-white bg-opacity-50 hover:bg-opacity-80 text-gray-800 font-medium rounded-lg transition border border-gray-200">
                        <i class="fas fa-chart-bar mr-2 text-teal-600"></i>Generate Report
                    </a>
                </div>
            </div>

            <!-- Revenue by Trainer Card -->
            <div class="glass-card rounded-xl p-6 hover:shadow-xl transition duration-300">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg p-3 shadow-md">
                        <i class="fas fa-dollar-sign text-xl text-white"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-900">Revenue by Trainer</h3>
                        <p class="text-sm text-gray-600">Top earning trainers</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.reports.revenue-by-trainer') }}" class="block w-full text-center px-4 py-2 bg-white bg-opacity-50 hover:bg-opacity-80 text-gray-800 font-medium rounded-lg transition border border-gray-200">
                        <i class="fas fa-trophy mr-2 text-emerald-600"></i>Generate Report
                    </a>
                </div>
            </div>

            <!-- Member Retention Card -->
            <div class="glass-card rounded-xl p-6 hover:shadow-xl transition duration-300">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg p-3 shadow-md">
                        <i class="fas fa-user-check text-xl text-white"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-900">Member Retention</h3>
                        <p class="text-sm text-gray-600">Churn and retention rates</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.reports.member-retention') }}" class="block w-full text-center px-4 py-2 bg-white bg-opacity-50 hover:bg-opacity-80 text-gray-800 font-medium rounded-lg transition border border-gray-200">
                        <i class="fas fa-user-clock mr-2 text-indigo-600"></i>Generate Report
                    </a>
                </div>
            </div>

            <!-- Upcoming Expirations Card -->
            <div class="glass-card rounded-xl p-6 hover:shadow-xl transition duration-300">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg p-3 shadow-md">
                        <i class="fas fa-exclamation-circle text-xl text-white"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-900">Expirations</h3>
                        <p class="text-sm text-gray-600">Memberships ending soon</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.reports.upcoming-expirations') }}" class="block w-full text-center px-4 py-2 bg-white bg-opacity-50 hover:bg-opacity-80 text-gray-800 font-medium rounded-lg transition border border-gray-200">
                        <i class="fas fa-clock mr-2 text-yellow-600"></i>Generate Report
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection