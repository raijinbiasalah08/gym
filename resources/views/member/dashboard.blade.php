@extends('layouts.app')

@section('title', 'Member Dashboard - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Member Dashboard</h1>
                <p class="text-sm text-gray-600 mt-1">Overview of your bookings, progress, and upcoming sessions.</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('member.bookings.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-sm font-medium rounded-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <i class="fas fa-calendar-plus mr-2"></i>Book Session
                </a>
                <a href="{{ route('member.progress.index') }}" class="inline-flex items-center px-4 py-2 glass-card text-gray-700 text-sm font-medium rounded-lg hover:bg-white hover:bg-opacity-60 transition">
                    <i class="fas fa-chart-line mr-2"></i>View Progress
                </a>
            </div>
        </div>
        
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            <!-- Upcoming Sessions -->
            <div class="glass-card overflow-hidden rounded-xl transition hover:shadow-lg group">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-calendar-alt text-2xl text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-600 truncate">Upcoming Sessions</dt>
                                <dd class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['upcoming_sessions'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Completed Sessions -->
            <div class="glass-card overflow-hidden rounded-xl transition hover:shadow-lg group">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-xl bg-gradient-to-br from-green-500 to-green-600 p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-check-circle text-2xl text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-600 truncate">Completed Sessions</dt>
                                <dd class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['completed_sessions'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Workouts -->
            <div class="glass-card overflow-hidden rounded-xl transition hover:shadow-lg group">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-dumbbell text-2xl text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-600 truncate">Total Workouts</dt>
                                <dd class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['total_workouts'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Payments -->
            <div class="glass-card overflow-hidden rounded-xl transition hover:shadow-lg group">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 p-3 shadow-lg group-hover:scale-110 transition-transform">
                                <i class="fas fa-money-bill-wave text-2xl text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-600 truncate">Pending Payments</dt>
                                <dd class="text-2xl font-bold text-gray-900 mt-1">{{ $stats['pending_payments'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Membership & Payments -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 mb-8">
            <!-- Membership Card -->
            <div class="glass-card rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-id-card text-blue-600 mr-2"></i>
                    Membership
                </h3>
                <div class="space-y-3">
                    <div>
                        <div class="text-2xl font-bold text-gray-900">{{ auth()->user()->membership_type ?? 'Standard' }}</div>
                        <div class="text-sm text-gray-600 mt-1">
                            Status: 
                            @php $status = auth()->user()->membership_status ?? 'active'; @endphp
                            @if($status === 'active')
                                <span class="bg-gradient-to-r from-green-500 to-green-600 text-white text-xs px-2 py-1 rounded-full font-medium">Active</span>
                            @elseif($status === 'expiring_soon')
                                <span class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white text-xs px-2 py-1 rounded-full font-medium">
                                    Expiring Soon ({{ auth()->user()->membership_days_remaining ?? 0 }} days)
                                </span>
                            @else
                                <span class="bg-gradient-to-r from-red-500 to-red-600 text-white text-xs px-2 py-1 rounded-full font-medium">{{ ucfirst($status) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="pt-3 border-t border-gray-200 border-opacity-50">
                        <div class="flex space-x-2">
                            <a href="{{ route('member.progress.index') }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-medium rounded-lg hover:shadow-lg transition">
                                <i class="fas fa-chart-line mr-1"></i>Progress
                            </a>
                            <a href="{{ route('member.bookings.index') }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 glass-card text-gray-700 text-sm font-medium rounded-lg hover:bg-white hover:bg-opacity-60 transition">
                                <i class="fas fa-calendar mr-1"></i>Bookings
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Payments -->
            <div class="glass-card rounded-xl lg:col-span-2 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 border-opacity-50 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-receipt text-green-600 mr-2"></i>
                        Recent Payments
                    </h3>
                    <a href="{{ route('member.payments.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View all →</a>
                </div>
                <div class="p-6">
                    @if(isset($recentPayments) && $recentPayments->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-gray-200 border-opacity-50">
                                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Amount</th>
                                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 divide-opacity-30">
                                @foreach($recentPayments as $p)
                                <tr class="hover:bg-white hover:bg-opacity-30 transition">
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ \Carbon\Carbon::parse($p->created_at)->format('M d, Y') }}</td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-900">${{ number_format($p->amount, 2) }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        @if($p->status == 'paid')
                                            <span class="bg-gradient-to-r from-green-500 to-green-600 text-white text-xs px-2 py-1 rounded-full font-medium">Paid</span>
                                        @else
                                            <span class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white text-xs px-2 py-1 rounded-full font-medium">{{ ucfirst($p->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right text-sm">
                                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Receipt</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-receipt text-4xl mb-2 opacity-50"></i>
                        <p>No recent payments</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Today's Session & Recent Progress -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Today's Session -->
            <div class="glass-card rounded-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 border-opacity-50">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-clock text-blue-600 mr-2"></i>
                        Today's Session
                    </h3>
                </div>
                <div class="p-6">
                    @if(isset($todaySession) && $todaySession)
                    <div class="text-center">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-full p-4 w-16 h-16 flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-dumbbell text-2xl text-white"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900">{{ $todaySession->session_type }}</h4>
                        <p class="text-sm text-gray-600 mt-2">with {{ $todaySession->trainer->name }}</p>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ \Carbon\Carbon::parse($todaySession->start_time)->format('g:i A') }} - 
                            {{ \Carbon\Carbon::parse($todaySession->end_time)->format('g:i A') }}
                        </p>
                        <div class="mt-4">
                            <span class="bg-gradient-to-r from-green-500 to-green-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                                Confirmed
                            </span>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-calendar-times text-4xl mb-3 opacity-50"></i>
                        <p class="mb-3">No session scheduled for today</p>
                        <a href="{{ route('member.bookings.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-medium rounded-lg hover:shadow-lg transition">
                            <i class="fas fa-plus mr-2"></i>Book a Session
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Recent Progress & Attendance -->
            <div class="glass-card rounded-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 border-opacity-50">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-chart-line text-purple-600 mr-2"></i>
                        Recent Progress
                    </h3>
                </div>
                <div class="divide-y divide-gray-200 divide-opacity-30">
                    @forelse($recentProgress ?? [] as $progress)
                    <div class="px-6 py-4 hover:bg-white hover:bg-opacity-30 transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-sm font-semibold text-gray-900">
                                    {{ \Carbon\Carbon::parse($progress->record_date)->format('M d, Y') }}
                                </div>
                                <div class="text-sm text-gray-600">Weight: {{ $progress->weight }} kg</div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900">BMI: {{ $progress->bmi }}</div>
                                <div class="text-sm text-gray-600">Body Fat: {{ $progress->body_fat_percentage ?? 'N/A' }}%</div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-chart-line text-4xl mb-2 opacity-50"></i>
                        <p>No progress records yet</p>
                    </div>
                    @endforelse
                </div>
                
                <!-- Recent Attendance -->
                <div class="px-6 py-4 border-t border-gray-200 border-opacity-50">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-sm font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-clipboard-check text-green-600 mr-2"></i>
                            Recent Attendance
                        </h4>
                        <a href="{{ route('member.attendance.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View all →</a>
                    </div>
                    @if(isset($recentAttendance) && $recentAttendance->count() > 0)
                    <div class="space-y-2">
                        @foreach($recentAttendance as $att)
                        <div class="flex justify-between items-center py-2 px-3 rounded-lg hover:bg-white hover:bg-opacity-30 transition">
                            <div class="text-sm text-gray-700">{{ \Carbon\Carbon::parse($att->date)->format('M d, Y') }}</div>
                            <div class="text-sm text-gray-600">
                                {{ $att->check_in ? \Carbon\Carbon::parse($att->check_in)->format('g:i A') : '—' }} – 
                                {{ $att->check_out ? \Carbon\Carbon::parse($att->check_out)->format('g:i A') : '—' }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-sm text-gray-500 text-center py-4">No attendance recorded yet.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection