@extends('layouts.app')

@section('title', 'Trainer Dashboard - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Trainer Dashboard</h1>
        
        <!-- Stats Grid -->
        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Clients -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-users text-2xl text-blue-600"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Clients</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['total_clients'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Sessions -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-calendar-alt text-2xl text-green-600"></i>
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
                            <i class="fas fa-check-circle text-2xl text-purple-600"></i>
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

            <!-- Active Plans -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-clipboard-list text-2xl text-red-600"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Active Plans</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $stats['active_plans'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Sessions -->
        <div class="mt-8">
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Today's Sessions</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($todaySessions as $session)
                    <div class="px-4 py-4 sm:px-6 hover:bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-user text-lg text-gray-400"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $session->member->name }}</div>
                                    <div class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($session->start_time)->format('g:i A') }} - 
                                        {{ \Carbon\Carbon::parse($session->end_time)->format('g:i A') }}
                                    </div>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500">
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                                    {{ ucfirst(str_replace('_', ' ', $session->session_type)) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-calendar-times text-3xl mb-2"></i>
                        <p>No sessions scheduled for today</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection