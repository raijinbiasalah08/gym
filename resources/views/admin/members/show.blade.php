@extends('layouts.app')

@section('title', 'Member Details - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Member Details</h1>
                <p class="text-sm text-gray-600 mt-1">Complete member profile and activity</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.members.index') }}" 
                   class="px-4 py-2 glass-card text-gray-700 font-medium rounded-lg hover:bg-white hover:bg-opacity-60 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
                <a href="{{ route('admin.members.edit', $member) }}" 
                   class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <i class="fas fa-edit mr-2"></i>Edit Member
                </a>
            </div>
        </div>

        <!-- Member Header Card -->
        <div class="glass-card rounded-xl p-6 mb-6">
            <div class="flex items-center space-x-6">
                <div class="flex-shrink-0">
                    <div class="h-24 w-24 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center shadow-lg">
                        <span class="text-white font-bold text-4xl">{{ substr($member->name, 0, 1) }}</span>
                    </div>
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $member->name }}</h2>
                    <p class="text-gray-600 mt-1">{{ $member->email }}</p>
                    <div class="flex items-center space-x-3 mt-3">
                        @if($member->is_active)
                            <span class="bg-gradient-to-r from-green-500 to-green-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                                Active
                            </span>
                        @else
                            <span class="bg-gradient-to-r from-red-500 to-red-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                                Inactive
                            </span>
                        @endif
                        <span class="bg-gradient-to-r from-purple-500 to-purple-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm capitalize">
                            {{ $member->membership_type }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
            <div class="glass-card rounded-xl p-6 hover:shadow-lg transition">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 p-3 shadow-lg">
                            <i class="fas fa-calendar-check text-2xl text-white"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-gray-900">{{ $bookingsCount }}</div>
                        <div class="text-sm text-gray-600">Total Bookings</div>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-xl p-6 hover:shadow-lg transition">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-xl bg-gradient-to-br from-green-500 to-green-600 p-3 shadow-lg">
                            <i class="fas fa-dollar-sign text-2xl text-white"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-gray-900">{{ $paymentsCount }}</div>
                        <div class="text-sm text-gray-600">Payments</div>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-xl p-6 hover:shadow-lg transition">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 p-3 shadow-lg">
                            <i class="fas fa-dumbbell text-2xl text-white"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-gray-900">{{ $attendanceCount }}</div>
                        <div class="text-sm text-gray-600">Gym Visits</div>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-xl p-6 hover:shadow-lg transition">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 p-3 shadow-lg">
                            <i class="fas fa-chart-line text-2xl text-white"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-gray-900">{{ $progressCount }}</div>
                        <div class="text-sm text-gray-600">Progress Records</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Personal Information -->
            <div class="glass-card rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-user text-blue-600 mr-2"></i>
                    Personal Information
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Full Name</label>
                        <p class="mt-1 text-gray-900">{{ $member->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Email Address</label>
                        <p class="mt-1 text-gray-900">{{ $member->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Phone Number</label>
                        <p class="mt-1 text-gray-900">{{ $member->phone ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Date of Birth</label>
                        <p class="mt-1 text-gray-900">{{ $member->date_of_birth ? $member->date_of_birth->format('M d, Y') . ' (' . $member->date_of_birth->age . ' years)' : 'Not provided' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Address</label>
                        <p class="mt-1 text-gray-900">{{ $member->address ?? 'Not provided' }}</p>
                    </div>
                </div>
            </div>

            <!-- Membership Information -->
            <div class="glass-card rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-id-card text-purple-600 mr-2"></i>
                    Membership Information
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Membership Type</label>
                        <p class="mt-1 text-gray-900 capitalize">{{ $member->membership_type }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Membership Expiry</label>
                        <p class="mt-1 text-gray-900">{{ $member->membership_expiry->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Account Status</label>
                        <p class="mt-1">
                            @if($member->is_active)
                                <span class="bg-gradient-to-r from-green-500 to-green-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                                    Active
                                </span>
                            @else
                                <span class="bg-gradient-to-r from-red-500 to-red-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                                    Inactive
                                </span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Membership Status</label>
                        <p class="mt-1">
                            @if($member->membership_status === 'active')
                                <span class="bg-gradient-to-r from-green-500 to-green-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                                    Active
                                </span>
                            @else
                                <span class="bg-gradient-to-r from-red-500 to-red-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm capitalize">
                                    {{ $member->membership_status }}
                                </span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Member Since</label>
                        <p class="mt-1 text-gray-900">{{ $member->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Health Information -->
            @if($member->height || $member->weight || $member->emergency_contact || $member->health_notes)
            <div class="glass-card rounded-xl p-6 lg:col-span-2">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-heartbeat text-red-600 mr-2"></i>
                    Health Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @if($member->height)
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Height</label>
                        <p class="mt-1 text-gray-900">{{ $member->height }} cm</p>
                    </div>
                    @endif
                    @if($member->weight)
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Weight</label>
                        <p class="mt-1 text-gray-900">{{ $member->weight }} kg</p>
                    </div>
                    @endif
                    @if($member->emergency_contact)
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Emergency Contact</label>
                        <p class="mt-1 text-gray-900">{{ $member->emergency_contact }}</p>
                    </div>
                    @endif
                    @if($member->health_notes)
                    <div class="md:col-span-3">
                        <label class="text-sm font-semibold text-gray-600">Health Notes</label>
                        <p class="mt-1 text-gray-900">{{ $member->health_notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Recent Bookings -->
            <div class="glass-card rounded-xl p-6 lg:col-span-2">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-calendar-alt text-green-600 mr-2"></i>
                    Recent Bookings
                </h3>
                @if($member->bookings && $member->bookings->count() > 0)
                    <div class="space-y-3">
                        @foreach($member->bookings->take(5) as $booking)
                        <div class="flex justify-between items-center p-4 bg-white bg-opacity-40 rounded-lg hover:bg-opacity-60 transition">
                            <div class="flex items-center space-x-4">
                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center shadow-md">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $booking->trainer->name ?? 'No Trainer' }}</p>
                                    <p class="text-xs text-gray-600">
                                        {{ $booking->booking_date->format('M d, Y') }} at {{ $booking->start_time }}
                                    </p>
                                </div>
                            </div>
                            @if($booking->status === 'confirmed')
                                <span class="bg-gradient-to-r from-green-500 to-green-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                                    Confirmed
                                </span>
                            @elseif($booking->status === 'pending')
                                <span class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                                    Pending
                                </span>
                            @elseif($booking->status === 'cancelled')
                                <span class="bg-gradient-to-r from-red-500 to-red-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                                    Cancelled
                                </span>
                            @else
                                <span class="bg-gradient-to-r from-gray-500 to-gray-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm capitalize">
                                    {{ $booking->status }}
                                </span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-calendar-times text-4xl mb-2 opacity-50"></i>
                        <p>No recent bookings found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection