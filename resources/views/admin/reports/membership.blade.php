@extends('layouts.app')

@section('title', 'Membership Report - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Membership Report</h1>
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.reports.index') }}" 
                   class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Reports
                </a>
                <a href="{{ route('admin.reports.membership.export') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                    <i class="fas fa-file-csv mr-2"></i>Download CSV
                </a>
            </div>
        </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Membership Type Breakdown -->
        <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="glass-card rounded-xl">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Membership Type Distribution</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($membershipStats as $stat)
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                @php
                                    $color = match($stat->membership_type) {
                                        'basic' => 'bg-brand-600',
                                        'premium' => 'bg-green-500',
                                        'vip' => 'bg-purple-500',
                                        default => 'bg-gray-500'
                                    };
                                @endphp
                                <span class="w-3 h-3 rounded-full {{ $color }} mr-3"></span>
                                <span class="text-sm font-medium text-gray-900 capitalize">{{ $stat->membership_type }}</span>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-medium text-gray-900">{{ $stat->count }} members</div>
                                <div class="text-sm text-gray-500">{{ $stat->active }} active</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Active vs Inactive -->
            <div class="glass-card rounded-xl">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Member Status</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <span class="w-3 h-3 rounded-full bg-green-500 mr-3"></span>
                                <span class="text-sm font-medium text-gray-900">Active Members</span>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-medium text-gray-900">{{ $activeMembers }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ number_format(($activeMembers / ($activeMembers + $inactiveMembers)) * 100, 1) }}%
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <span class="w-3 h-3 rounded-full bg-red-500 mr-3"></span>
                                <span class="text-sm font-medium text-gray-900">Inactive Members</span>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-medium text-gray-900">{{ $inactiveMembers }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ number_format(($inactiveMembers / ($activeMembers + $inactiveMembers)) * 100, 1) }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Membership Growth -->
        <div class="mt-6 glass-card rounded-xl">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Membership Growth (Last 12 Months)</h3>
            </div>
            <div class="p-6">
                @if($membershipGrowth->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 bg-opacity-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Period
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        New Members
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cumulative Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white bg-opacity-40 divide-y divide-gray-200">
                                @php
                                    $cumulative = 0;
                                @endphp
                                @foreach($membershipGrowth as $growth)
                                @php
                                    $cumulative += $growth->new_members;
                                    $period = \Carbon\Carbon::createFromDate($growth->year, $growth->month, 1);
                                @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $period->format('M Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $growth->new_members }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $cumulative }}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center text-gray-500 py-4">No membership growth data available.</p>
                @endif
            </div>
        </div>

        <!-- Expiring Memberships -->
        <div class="mt-6 glass-card rounded-xl">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Memberships Expiring Soon (Next 7 Days)</h3>
            </div>
            <div class="p-6">
                @php
                    $expiringMembers = \App\Models\User::members()->expiringSoon(7)->get();
                @endphp
                @if($expiringMembers->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 bg-opacity-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Member
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Membership Type
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Expiry Date
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Days Remaining
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white bg-opacity-40 divide-y divide-gray-200">
                                @foreach($expiringMembers as $member)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <i class="fas fa-user-circle text-2xl text-gray-400"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $member->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $member->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 capitalize">
                                            {{ $member->membership_type }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $member->membership_expiry->format('M d, Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium 
                                            @if($member->membership_days_remaining <= 3) text-red-600
                                            @elseif($member->membership_days_remaining <= 7) text-orange-600
                                            @else text-green-600 @endif">
                                            {{ $member->membership_days_remaining }} days
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center text-gray-500 py-4">No memberships expiring in the next 7 days.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection