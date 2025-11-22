@extends('layouts.app')

@section('title', 'Trainer Dashboard - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Trainer Dashboard</h1>
                <p class="text-sm text-gray-600 mt-1">Manage your sessions, clients and workout plans.</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('trainer.workout-plans.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-sm font-medium rounded-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <i class="fas fa-plus mr-2"></i>Create Plan
                </a>
                <a href="{{ route('trainer.bookings.index') }}" class="inline-flex items-center px-4 py-2 glass-card text-gray-700 text-sm font-medium rounded-lg hover:bg-white hover:bg-opacity-60 transition">
                    <i class="fas fa-calendar mr-2"></i>My Bookings
                </a>
            </div>
        </div>
        
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            <!-- Total Clients -->
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
                                <dt class="text-sm font-medium text-gray-600 truncate">Total Clients</dt>
                                <dd class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total_clients'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Sessions -->
            <div class="glass-card overflow-hidden rounded-xl transition hover:shadow-lg group">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-xl bg-gradient-to-br from-green-500 to-green-600 p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-calendar-day text-2xl text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-600 truncate">Today's Sessions</dt>
                                <dd class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['today_sessions'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Plans -->
            <div class="glass-card overflow-hidden rounded-xl transition hover:shadow-lg group">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-clipboard-list text-2xl text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-600 truncate">Active Plans</dt>
                                <dd class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['active_plans'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Sessions -->
            <div class="glass-card overflow-hidden rounded-xl transition hover:shadow-lg group">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-chart-line text-2xl text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-600 truncate">Total Sessions</dt>
                                <dd class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total_sessions'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Sessions & Recent Clients -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 mb-8">
            <!-- Today's Sessions -->
            <div class="glass-card rounded-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 border-opacity-50">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-calendar-day text-green-600 mr-2"></i>
                        Today's Sessions
                    </h3>
                </div>
                <div class="divide-y divide-gray-200 divide-opacity-30">
                    @forelse($todaySessions ?? [] as $session)
                    <div class="px-6 py-4 hover:bg-white hover:bg-opacity-30 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center shadow-md">
                                        <span class="text-white font-bold text-lg">{{ substr($session->member->name, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $session->member->name }}</div>
                                    <div class="text-sm text-gray-600">{{ $session->session_type }}</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900">
                                    {{ \Carbon\Carbon::parse($session->start_time)->format('g:i A') }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($session->end_time)->format('g:i A') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-calendar-times text-4xl mb-2 opacity-50"></i>
                        <p>No sessions scheduled for today</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Clients -->
            <div class="glass-card rounded-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 border-opacity-50">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-user-friends text-blue-600 mr-2"></i>
                        Recent Clients
                    </h3>
                </div>
                <div class="divide-y divide-gray-200 divide-opacity-30">
                    @forelse($recentClients ?? [] as $client)
                    <div class="px-6 py-4 hover:bg-white hover:bg-opacity-30 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center shadow-md">
                                        <span class="text-white font-bold text-lg">{{ substr($client->name, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $client->name }}</div>
                                    <div class="text-sm text-gray-600">{{ $client->email }}</div>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('trainer.progress.create') }}?member_id={{ $client->id }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                    Track Progress
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-users text-4xl mb-2 opacity-50"></i>
                        <p>No clients yet</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Attendance & Workout Plans -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Recent Attendance -->
            <div class="glass-card rounded-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 border-opacity-50 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-clipboard-check text-green-600 mr-2"></i>
                        Recent Attendance
                    </h3>
                    <a href="{{ route('trainer.attendance.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View all →</a>
                </div>
                <div class="divide-y divide-gray-200 divide-opacity-30">
                    @forelse($recentAttendance ?? [] as $attendance)
                    <div class="px-6 py-4 hover:bg-white hover:bg-opacity-30 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm font-semibold text-gray-900">{{ $attendance->member->name }}</div>
                                <div class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-900">
                                    {{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('g:i A') : 'N/A' }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $attendance->workout_duration ?? 0 }} mins
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-clipboard-check text-4xl mb-2 opacity-50"></i>
                        <p>No recent attendance</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Active Workout Plans -->
            <div class="glass-card rounded-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 border-opacity-50 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-dumbbell text-purple-600 mr-2"></i>
                        Active Workout Plans
                    </h3>
                    <a href="{{ route('trainer.workout-plans.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View all →</a>
                </div>
                <div class="divide-y divide-gray-200 divide-opacity-30">
                    @forelse($activePlans ?? [] as $plan)
                    <div class="px-6 py-4 hover:bg-white hover:bg-opacity-30 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm font-semibold text-gray-900">{{ $plan->name }}</div>
                                <div class="text-sm text-gray-600">{{ $plan->member->name ?? 'Unassigned' }}</div>
                            </div>
                            <div>
                                <span class="bg-gradient-to-r from-green-500 to-green-600 text-white text-xs px-2 py-1 rounded-full font-medium shadow-sm">
                                    Active
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-dumbbell text-4xl mb-2 opacity-50"></i>
                        <p>No active workout plans</p>
                        <a href="{{ route('trainer.workout-plans.create') }}" class="inline-block mt-3 px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-600 text-white text-sm font-medium rounded-lg hover:shadow-lg transition">
                            <i class="fas fa-plus mr-2"></i>Create Plan
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection