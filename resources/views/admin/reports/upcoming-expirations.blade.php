@extends('layouts.app')

@section('title', 'Upcoming Expirations - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Upcoming Expirations</h1>
            <div class="flex items-center space-x-2">
                <x-button-secondary :href="route('admin.reports.index')">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Reports
                </x-button-secondary>
                <x-button-primary :href="route('admin.reports.upcoming-expirations.export', ['days' => request('days', 30)])">
                    <i class="fas fa-file-csv mr-2"></i>Download CSV
                </x-button-primary>
            </div>
        </div>

        <div class="mt-6 glass-card rounded-xl">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Expirations Filter</h3>
                <p class="mt-1 text-sm text-gray-500">Choose how many days ahead to show memberships that will expire.</p>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('admin.reports.upcoming-expirations') }}" method="GET">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                        <div>
                            <label for="days" class="block text-sm font-medium text-gray-700">Next (days)</label>
                            <input type="number" name="days" id="days" min="1" value="{{ request('days', $days ?? 30) }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-600 focus:border-blue-600 sm:text-sm">
                        </div>

                        <div class="flex items-end md:col-span-2">
                            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-filter mr-2"></i>Show Expirations
                            </button>
                        </div>
                    </div>
                </form>
                <div class="mt-4 flex justify-end">
                    <x-button-primary :href="route('admin.reports.upcoming-expirations.export', ['days' => request('days', $days ?? 30)])">
                        <i class="fas fa-file-csv mr-2"></i>Download CSV
                    </x-button-primary>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="glass-card overflow-hidden rounded-xl">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg p-3 shadow-md">
                            <i class="fas fa-exclamation-triangle text-2xl text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Expiring</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $expiring->count() }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card overflow-hidden rounded-xl">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-3 shadow-md">
                            <i class="fas fa-calendar-day text-2xl text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Soonest Expiry</dt>
                                <dd class="text-lg font-medium text-gray-900">
                                    @php
                                        $soon = $expiring->sortBy('membership_expiry')->first();
                                    @endphp
                                    @if($soon && $soon->membership_expiry)
                                        {{ $soon->membership_expiry->format('M d, Y') }}
                                    @else
                                        —
                                    @endif
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card overflow-hidden rounded-xl">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-3 shadow-md">
                            <i class="fas fa-user-friends text-2xl text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Membership Types</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $expiring->pluck('membership_type')->filter()->count() }} types</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expiring Members Table -->
        <div class="mt-6 glass-card rounded-xl">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Memberships Expiring (Next {{ request('days', $days ?? 30) }} days)</h3>
            </div>
            <div class="p-6">
                @if($expiring->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 bg-opacity-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Membership Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expiry Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Days Remaining</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white bg-opacity-40 divide-y divide-gray-200">
                                @foreach($expiring as $member)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <i class="fas fa-user-circle text-2xl text-gray-400"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $member->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $member->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $member->membership_type }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ optional($member->membership_expiry)->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium @if($member->membership_expiry && $member->membership_expiry->diffInDays(now()) <= 3) text-red-600 @elseif($member->membership_expiry && $member->membership_expiry->diffInDays(now()) <= 7) text-orange-600 @else text-green-600 @endif">
                                        {{ $member->membership_expiry ? $member->membership_expiry->diffInDays(now()) : '-' }} days
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center text-gray-500 py-6">No expiring memberships in the selected range.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
