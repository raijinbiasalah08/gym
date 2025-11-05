@extends('layouts.app')

@section('title', 'Admin Dashboard - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Admin Dashboard</h1>
        
        <!-- Stats Grid -->
        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Total Members -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-users text-3xl text-blue-600"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Members</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['total_members'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Trainers -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-dumbbell text-3xl text-green-600"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Trainers</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['total_trainers'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Bookings -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-calendar-check text-3xl text-purple-600"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Active Bookings</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['active_bookings'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Payments -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-money-bill-wave text-3xl text-yellow-600"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Pending Payments</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['pending_payments'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-chart-line text-3xl text-green-600"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Revenue</dt>
                                <dd class="text-lg font-medium text-gray-900">${{ number_format($stats['total_revenue'], 2) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Attendance -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-clipboard-check text-3xl text-red-600"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Today's Attendance</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['today_attendance'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Members & Payments -->
        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Recent Members -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Members</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($recentMembers as $member)
                    <div class="px-4 py-4 sm:px-6 hover:bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-user-circle text-2xl text-gray-400"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $member->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $member->email }}</div>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500">
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                    {{ ucfirst($member->membership_type) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Payments -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Payments</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($recentPayments as $payment)
                    <div class="px-4 py-4 sm:px-6 hover:bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $payment->member->name }}</div>
                                <div class="text-sm text-gray-500">{{ $payment->description }}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-medium text-gray-900">${{ number_format($payment->amount, 2) }}</div>
                                <div class="text-sm text-gray-500">
                                    <span class="bg-{{ $payment->status == 'paid' ? 'green' : 'yellow' }}-100 text-{{ $payment->status == 'paid' ? 'green' : 'yellow' }}-800 text-xs px-2 py-1 rounded-full">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Monthly Revenue Chart -->
        <div class="mt-8 bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Monthly Revenue</h3>
                <p class="mt-1 text-sm text-gray-500">Total revenue for the current month.</p>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-gray-900">${{ number_format($monthlyRevenue, 2) }}</div>
                    <p class="mt-2 text-sm text-gray-500">Revenue for {{ now()->format('F Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection