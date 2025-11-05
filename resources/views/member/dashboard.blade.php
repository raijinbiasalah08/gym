@extends('layouts.app')

@section('title', 'Member Dashboard - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Member Dashboard</h1>
        
        <!-- Stats Grid -->
        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Upcoming Sessions -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-calendar-alt text-2xl text-blue-600"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Upcoming Sessions</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['upcoming_sessions'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Completed Sessions -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-2xl text-green-600"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Completed Sessions</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['completed_sessions'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Workouts -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-dumbbell text-2xl text-purple-600"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Workouts</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['total_workouts'] }}</dd>
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
                            <i class="fas fa-money-bill-wave text-2xl text-yellow-600"></i>
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
        </div>

        <!-- Today's Session & Recent Progress -->
        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Today's Session -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Today's Session</h3>
                </div>
                <div class="p-6">
                    @if($todaySession)
                    <div class="text-center">
                        <i class="fas fa-clock text-3xl text-blue-600 mb-4"></i>
                        <h4 class="text-lg font-medium text-gray-900">{{ $todaySession->session_type }}</h4>
                        <p class="text-sm text-gray-500 mt-2">with {{ $todaySession->trainer->name }}</p>
                        <p class="text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($todaySession->start_time)->format('g:i A') }} - 
                            {{ \Carbon\Carbon::parse($todaySession->end_time)->format('g:i A') }}
                        </p>
                        <div class="mt-4">
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                Confirmed
                            </span>
                        </div>
                    </div>
                    @else
                    <div class="text-center text-gray-500">
                        <i class="fas fa-calendar-times text-3xl mb-2"></i>
                        <p>No session scheduled for today</p>
                        <a href="{{ route('member.bookings.create') }}" class="inline-block mt-2 text-blue-600 hover:text-blue-500">
                            Book a session
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Recent Progress -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Progress</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($recentProgress as $progress)
                    <div class="px-4 py-4 sm:px-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-sm font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($progress->record_date)->format('M d, Y') }}
                                </div>
                                <div class="text-sm text-gray-500">Weight: {{ $progress->weight }} kg</div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-medium text-gray-900">BMI: {{ $progress->bmi }}</div>
                                <div class="text-sm text-gray-500">Body Fat: {{ $progress->body_fat_percentage }}%</div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-chart-line text-3xl mb-2"></i>
                        <p>No progress records yet</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection