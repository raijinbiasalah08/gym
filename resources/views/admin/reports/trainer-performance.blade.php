@extends('layouts.app')

@section('title', 'Trainer Performance Report - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Trainer Performance Report</h1>
            <div class="flex items-center space-x-2">
                <x-button-secondary :href="route('admin.reports.index')">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Reports
                </x-button-secondary>
                @if(request()->has('start_date'))
                <x-button-primary :href="route('admin.reports.trainer-performance.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')])">
                    <i class="fas fa-file-csv mr-2"></i>Download CSV
                </x-button-primary>
                @endif
            </div>
        </div>

        <!-- Report Filters -->
        <div class="mt-6 glass-card rounded-xl">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('admin.reports.trainer-performance') }}" method="GET">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="start_date" required
                                   value="{{ request('start_date', now()->subMonth()->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-orange-600 focus:border-orange-600 sm:text-sm">
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="end_date" id="end_date" required
                                   value="{{ request('end_date', now()->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-brand-600 focus:border-brand-600 sm:text-sm">
                        </div>

                        <div class="flex items-end">
                                <button type="submit" 
                                    class="w-full bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700 transition focus:outline-none focus:ring-2 focus:ring-orange-500">
                                <i class="fas fa-filter mr-2"></i>Generate Report
                            </button>
                        </div>
                    </div>
                </form>
                @if(request()->has('start_date'))
                <div class="mt-4 flex justify-end">
                    <a href="{{ route('admin.reports.trainer-performance.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                       class="inline-flex items-center px-4 py-2 bg-orange-600 text-white text-sm rounded-md hover:bg-orange-700">
                        <i class="fas fa-file-csv mr-2"></i>Download CSV
                    </a>
                </div>
                @endif
            </div>
        </div>

        @if(request()->has('start_date'))
        <!-- Summary Stats -->
        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-4">
            <div class="glass-card overflow-hidden rounded-xl">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-brand-500 to-brand-600 rounded-lg p-3 shadow-md">
                            <i class="fas fa-dumbbell text-2xl text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Trainers</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $trainerPerformance->count() }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card overflow-hidden rounded-xl">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-3 shadow-md">
                            <i class="fas fa-calendar-check text-2xl text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Sessions</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $trainerPerformance->sum('total_sessions') }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card overflow-hidden rounded-xl">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg p-3 shadow-md">
                            <i class="fas fa-money-bill-wave text-2xl text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Earnings</dt>
                                <dd class="text-lg font-medium text-gray-900">₱{{ number_format($trainerPerformance->sum('total_earnings'), 2) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card overflow-hidden rounded-xl">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg p-3 shadow-md">
                            <i class="fas fa-clipboard-list text-2xl text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Active Plans</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $trainerPerformance->sum('active_plans') }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trainer Performance Table -->
        <div class="mt-6 glass-card rounded-xl">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Trainer Performance Details</h3>
                <p class="mt-1 text-sm text-gray-500">Individual trainer performance metrics for the selected period.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 bg-opacity-50">

        <!-- Top Performers -->
        <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Top by Sessions -->
            <div class="glass-card rounded-xl">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Most Sessions</h3>
                </div>
                <div class="p-6">
                    @php $topSessions = $trainerPerformance->sortByDesc('total_sessions')->take(3); @endphp
                    @foreach($topSessions as $trainer)
                    <div class="flex justify-between items-center py-2">
                        <div class="text-sm font-medium text-gray-900">{{ $trainer->name }}</div>
                        <div class="text-sm text-gray-500">{{ $trainer->total_sessions }} sessions</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Top by Earnings -->
            <div class="glass-card rounded-xl">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Highest Earnings</h3>
                </div>
                <div class="p-6">
                    @php $topEarnings = $trainerPerformance->sortByDesc('total_earnings')->take(3); @endphp
                    @foreach($topEarnings as $trainer)
                    <div class="flex justify-between items-center py-2">
                        <div class="text-sm font-medium text-gray-900">{{ $trainer->name }}</div>
                        <div class="text-sm text-gray-500">₱{{ number_format($trainer->total_earnings, 2) }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Top by Activity -->
            <div class="glass-card rounded-xl">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Most Active Plans</h3>
                </div>
                <div class="p-6">
                    @php $topPlans = $trainerPerformance->sortByDesc('active_plans')->take(3); @endphp
                    @foreach($topPlans as $trainer)
                    <div class="flex justify-between items-center py-2">
                        <div class="text-sm font-medium text-gray-900">{{ $trainer->name }}</div>
                        <div class="text-sm text-gray-500">{{ $trainer->active_plans }} plans</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Report Period -->
        <div class="mt-4 text-center text-sm text-gray-500">
            Report generated for period: {{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }} to {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}
        </div>
        @endif
    </div>
</div>
@endsection