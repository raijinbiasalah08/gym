@extends('layouts.app')

@section('title', 'Class Utilization - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Class Utilization</h1>
            <div class="flex items-center space-x-2">
                <x-button-secondary :href="route('admin.reports.index')">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Reports
                </x-button-secondary>
                @if(request()->has('start_date'))
                <x-button-primary :href="route('admin.reports.class-utilization.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')])">
                    <i class="fas fa-file-csv mr-2"></i>Download CSV
                </x-button-primary>
                @endif
            </div>
        </div>

        <div class="mt-6 glass-card rounded-xl">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('admin.reports.class-utilization') }}" method="GET">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="start_date" required
                                   value="{{ request('start_date', now()->subMonth()->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-600 focus:border-blue-600 sm:text-sm">
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="end_date" id="end_date" required
                                   value="{{ request('end_date', now()->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-600 focus:border-blue-600 sm:text-sm">
                        </div>

                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-filter mr-2"></i>Generate Report
                            </button>
                        </div>
                    </div>
                </form>

                @if(request()->has('start_date'))
                <div class="mt-4 flex justify-end">
                    <a href="{{ route('admin.reports.class-utilization.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                        <i class="fas fa-file-csv mr-2"></i>Download CSV
                    </a>
                </div>
                @endif
            </div>
        </div>

        @if(request()->has('start_date'))
        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="glass-card overflow-hidden rounded-xl">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-teal-500 to-teal-600 rounded-lg p-3 shadow-md">
                            <i class="fas fa-users-cog text-2xl text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Session Types</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $utilization->count() }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card overflow-hidden rounded-xl">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg p-3 shadow-md">
                            <i class="fas fa-clock text-2xl text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Avg Duration</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ round($utilization->avg('avg_duration') ?? 0,1) }} mins</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card overflow-hidden rounded-xl">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-3 shadow-md">
                            <i class="fas fa-chart-bar text-2xl text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Most Used</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $utilization->first()->session_type ?? '—' }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 glass-card rounded-xl">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Session Types</h3>
            </div>
            <div class="p-6">
                @if($utilization->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 bg-opacity-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Session Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Sessions</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avg Duration (mins)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white bg-opacity-40 divide-y divide-gray-200">
                            @foreach($utilization as $u)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $u->session_type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $u->total_sessions }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ round($u->avg_duration,1) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-center text-gray-500 py-6">No classes found for the selected period.</p>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
