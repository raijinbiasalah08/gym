@extends('layouts.app')

@section('title', 'Financial Report - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Financial Report</h1>
            <div class="flex items-center space-x-2">
                <x-button-secondary :href="route('admin.reports.index')">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Reports
                </x-button-secondary>
                @if(request()->has('start_date'))
                <x-button-primary :href="route('admin.reports.financial.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')])">
                    <i class="fas fa-file-csv mr-2"></i>Download CSV
                </x-button-primary>
                @endif
            </div>
        </div>

        <!-- Report Filters -->
        <div class="mt-6 glass-card rounded-xl">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('admin.reports.financial') }}" method="GET">
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
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-brand-600 focus:border-brand-600 sm:text-sm">
                        </div>

                        <div class="flex items-end">
                            <x-button-primary type="submit">
                                <i class="fas fa-filter mr-2"></i>Generate Report
                            </x-button-primary>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>

        @if(request()->has('start_date'))
        <!-- Summary Cards -->
        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="glass-card overflow-hidden rounded-xl">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-3 shadow-md">
                            <i class="fas fa-money-bill-wave text-2xl text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Revenue</dt>
                                <dd class="text-lg font-medium text-gray-900">${{ number_format($totalRevenue, 2) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card overflow-hidden rounded-xl">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-3 shadow-md">
                            <i class="fas fa-credit-card text-2xl text-white"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Transactions</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $paymentMethods->sum('count') }}</dd>
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
                                <dt class="text-sm font-medium text-gray-500 truncate">Active Payers</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $topMembers->count() }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Methods Breakdown -->
        <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="glass-card rounded-xl">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Payment Methods</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($paymentMethods as $method)
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <span class="w-3 h-3 rounded-full bg-brand-600 mr-3"></span>
                                <span class="text-sm font-medium text-gray-900 capitalize">{{ $method->payment_method }}</span>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-medium text-gray-900">${{ number_format($method->total, 2) }}</div>
                                <div class="text-sm text-gray-500">{{ $method->count }} transactions</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Monthly Revenue Trend -->
            <div class="glass-card rounded-xl">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Revenue Trend</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        @foreach($monthlyRevenue as $revenue)
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-gray-900">
                                {{ \Carbon\Carbon::createFromDate($revenue->year, $revenue->month, 1)->format('M Y') }}
                            </div>
                            <div class="text-sm font-medium text-gray-900">
                                ${{ number_format($revenue->total, 2) }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Members -->
        <div class="mt-6 glass-card rounded-xl">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Top Members by Spending</h3>
            </div>
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
                                Total Spent
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Transactions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white bg-opacity-40 divide-y divide-gray-200">
                        @foreach($topMembers as $member)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <i class="fas fa-user-circle text-2xl text-gray-400"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $member->member->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $member->member->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 capitalize">
                                    {{ $member->member->membership_type }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    ${{ number_format($member->total_spent, 2) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $member->member->payments()->whereBetween('payment_date', [$startDate, $endDate])->count() }}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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