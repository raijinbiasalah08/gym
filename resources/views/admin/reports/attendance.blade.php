@extends('layouts.app')

@section('title', 'Attendance Report - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Attendance Report</h1>
            <div class="flex items-center space-x-2">
                <x-button-secondary :href="route('admin.reports.index')">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Reports
                </x-button-secondary>
                @if(request()->has('start_date'))
                <x-button-primary :href="route('admin.reports.attendance.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')])">
                    <i class="fas fa-file-csv mr-2"></i>Download CSV
                </x-button-primary>
                @endif
            </div>
        </div>

        <!-- Report Filters -->
        <div class="mt-6 glass-card rounded-xl">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('admin.reports.attendance') }}" method="GET">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="start_date" required
                                   value="{{ request('start_date', now()->subWeek()->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-600 focus:border-blue-600 sm:text-sm">
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="end_date" id="end_date" required
                                   value="{{ request('end_date', now()->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-600 focus:border-blue-600 sm:text-sm">
                        </div>

                        <div class="flex items-end">
                                <button type="submit" 
                                    class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-filter mr-2"></i>Generate Report
                            </button>
                        </div>
                    </div>
                </form>
                @if(request()->has('start_date'))
                <div class="mt-4 flex justify-end">
                    <a href="{{ route('admin.reports.attendance.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                        <i class="fas fa-file-csv mr-2"></i>Download CSV
                    </a>
                </div>
                @endif
            </div>
        </div>

        @if(request()->has('start_date'))
        <!-- Summary Cards -->
        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="glass-card overflow-hidden rounded-xl">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-brand-500 to-brand-600 rounded-lg p-3 shadow-md">
                            <i class="fas fa-door-open text-2xl text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Visits</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $attendance->sum('total_visits') ?? 0 }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card overflow-hidden rounded-xl">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-3 shadow-md">
                            <i class="fas fa-users text-2xl text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Unique Members</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $attendance->count() ?? 0 }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card overflow-hidden rounded-xl">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-red-500 to-red-600 rounded-lg p-3 shadow-md">
                            <i class="fas fa-fire text-2xl text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Calories Burned</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ number_format($attendance->sum('total_calories') ?? 0) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Member Attendance Summary -->
        <div class="mt-6 glass-card rounded-xl">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Member Attendance Summary</h3>
                <p class="mt-1 text-sm text-gray-500">Attendance details for each member during the selected period.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 bg-opacity-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Visits</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avg Duration</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Calories</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avg Calories/Visit</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white bg-opacity-40 divide-y divide-gray-200">
                        @foreach($attendance as $record)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <i class="fas fa-user-circle text-2xl text-gray-400"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $record->member->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $record->member->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm font-medium text-gray-900">{{ $record->total_visits }}</div></td>
                            <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-900">{{ number_format($record->avg_duration) }} min</div></td>
                            <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-900">{{ number_format($record->total_calories) }}</div></td>
                            <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-900">{{ $record->total_visits > 0 ? number_format($record->total_calories / $record->total_visits) : 0 }}</div></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Daily Attendance Trend / Peak Hours -->
        <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="glass-card rounded-xl">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Daily Attendance Trend</h3>
                </div>
                <div class="p-6">
                    @if($dailyAttendance->count() > 0)
                        <div class="space-y-3">
                            @foreach($dailyAttendance as $daily)
                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($daily->date)->format('M d, Y') }}</div>
                                <div class="text-sm font-medium text-gray-900">{{ $daily->visits }} visits</div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 py-4">No attendance data for the selected period.</p>
                    @endif
                </div>
            </div>

            <div class="glass-card rounded-xl">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Peak Hours</h3>
                </div>
                <div class="p-6">
                    @if($peakHours->count() > 0)
                        <div class="space-y-3">
                            @foreach($peakHours->take(5) as $hour)
                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-900">{{ $hour->hour }}:00 - {{ $hour->hour + 1 }}:00</div>
                                <div class="text-sm font-medium text-gray-900">{{ $hour->visits }} visits</div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 py-4">No peak hour data available.</p>
                    @endif
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