@extends('layouts.app')

@section('title', 'Booking Analytics - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Booking Analytics</h1>
            <div class="flex items-center space-x-2">
                <x-button-secondary :href="route('admin.reports.index')">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Reports
                </x-button-secondary>
                @if(request()->has('start_date'))
                <x-button-primary :href="route('admin.reports.booking-analytics.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')])">
                    <i class="fas fa-file-csv mr-2"></i>Download CSV
                </x-button-primary>
                @endif
            </div>
        </div>

        <div class="mt-6 glass-card rounded-xl">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('admin.reports.booking-analytics') }}" method="GET">
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
                            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-filter mr-2"></i>Generate Report
                            </button>
                        </div>
                    </div>
                </form>

                @if(request()->has('start_date'))
                <div class="mt-4 flex justify-end">
                    <a href="{{ route('admin.reports.booking-analytics.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                        <i class="fas fa-file-csv mr-2"></i>Download CSV
                    </a>
                </div>
                @endif
            </div>
        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 glass-card rounded-xl">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Daily Bookings</h3>
            </div>
            <div class="p-6">
                @if($daily->count() > 0)
                <div class="space-y-3">
                    @foreach($daily as $d)
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($d->date)->format('M d, Y') }}</div>
                        <div class="text-sm font-medium text-gray-900">{{ $d->bookings }} bookings</div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-center text-gray-500 py-6">No bookings for the selected period.</p>
                @endif
            </div>
        </div>

        <div class="mt-6 glass-card rounded-xl">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Status Breakdown</h3>
            </div>
            <div class="p-6">
                @if($statusCounts->count() > 0)
                <div class="space-y-3">
                    @foreach($statusCounts as $s)
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-900 capitalize">{{ $s->status }}</div>
                        <div class="text-sm font-medium text-gray-900">{{ $s->count }}</div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-center text-gray-500 py-6">No status data available.</p>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection