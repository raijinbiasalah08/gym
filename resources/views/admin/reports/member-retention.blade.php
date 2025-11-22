@extends('layouts.app')

@section('title', 'Member Retention - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Member Retention</h1>
            <div class="flex items-center space-x-2">
                <x-button-secondary :href="route('admin.reports.index')">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Reports
                </x-button-secondary>
                @if(request()->has('start_date'))
                <x-button-primary :href="route('admin.reports.member-retention.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')])">
                    <i class="fas fa-file-csv mr-2"></i>Download CSV
                </x-button-primary>
                @endif
            </div>
        </div>

        <div class="mt-6 glass-card rounded-xl">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('admin.reports.member-retention') }}" method="GET">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="start_date" required
                                   value="{{ request('start_date', now()->subMonths(1)->format('Y-m-d')) }}"
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
                    <a href="{{ route('admin.reports.member-retention.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                        <i class="fas fa-file-csv mr-2"></i>Download CSV
                    </a>
                </div>
                @endif
            </div>
        </div>

        @if(request()->has('start_date'))
        <div class="mt-6 glass-card rounded-xl">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Retention Summary</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div class="glass-card overflow-hidden rounded-xl p-5">
                        <div class="text-sm text-gray-500">Total Members with Bookings</div>
                        <div class="text-lg font-medium text-gray-900">{{ $total }}</div>
                    </div>
                    <div class="glass-card overflow-hidden rounded-xl p-5">
                        <div class="text-sm text-gray-500">Returning Members</div>
                        <div class="text-lg font-medium text-gray-900">{{ $returning }}</div>
                    </div>
                    <div class="glass-card overflow-hidden rounded-xl p-5">
                        <div class="text-sm text-gray-500">Retention Rate</div>
                        <div class="text-lg font-medium text-gray-900">{{ $retentionRate }}%</div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
