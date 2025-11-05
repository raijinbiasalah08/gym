@extends('layouts.app')

@section('title', $member->name . ' - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Member Details</h1>
            <div class="flex space-x-2">
                <a href="{{ route('admin.members.edit', $member) }}" 
                   class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('admin.members.index') }}" 
                   class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Member Information -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Personal Information</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $member->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $member->email }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Phone Number</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $member->phone }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Date of Birth</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $member->date_of_birth ? $member->date_of_birth->format('M d, Y') . ' (' . $member->date_of_birth->age . ' years)' : 'Not set' }}
                                </dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Address</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $member->address ?? 'Not provided' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Emergency Contact</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $member->emergency_contact ?? 'Not provided' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Health Notes</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $member->health_notes ?? 'No notes' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Physical Stats -->
                <div class="mt-6 bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Physical Statistics</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <dl class="grid grid-cols-2 gap-x-4 gap-y-6 sm:grid-cols-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Height</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $member->height ? $member->height . ' cm' : 'Not set' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Weight</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $member->weight ? $member->weight . ' kg' : 'Not set' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">BMI</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if($member->height && $member->weight)
                                        @php
                                            $heightInMeters = $member->height / 100;
                                            $bmi = $member->weight / ($heightInMeters * $heightInMeters);
                                        @endphp
                                        {{ number_format($bmi, 1) }}
                                    @else
                                        N/A
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="mt-6 bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Activity</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600">{{ $member->bookings_count }}</div>
                                <div class="text-sm text-gray-500">Bookings</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600">{{ $member->payments_count }}</div>
                                <div class="text-sm text-gray-500">Payments</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-purple-600">{{ $member->attendance_count }}</div>
                                <div class="text-sm text-gray-500">Workouts</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-yellow-600">{{ $member->progress_count }}</div>
                                <div class="text-sm text-gray-500">Progress</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Membership Status -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Membership</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                @if($member->membership_type == 'vip') bg-purple-100 text-purple-800
                                @elseif($member->membership_type == 'premium') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ strtoupper($member->membership_type) }}
                            </span>
                            <div class="mt-2">
                                <div class="text-sm text-gray-500">Expires</div>
                                <div class="text-lg font-semibold text-gray-900">
                                    {{ $member->membership_expiry ? $member->membership_expiry->format('M d, Y') : 'Not set' }}
                                </div>
                                <div class="text-sm text-gray-500 mt-1">
                                    @if($member->membership_expiry && $member->membership_expiry->isFuture())
                                        <span class="text-green-600">{{ $member->membership_expiry->diffForHumans() }}</span>
                                    @elseif($member->membership_expiry)
                                        <span class="text-red-600">Expired {{ $member->membership_expiry->diffForHumans() }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Status -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Account Status</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                @if($member->is_active) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                {{ $member->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            <div class="mt-4 space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Member Since:</span>
                                    <span class="font-medium">{{ $member->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Last Updated:</span>
                                    <span class="font-medium">{{ $member->updated_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Bookings -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Bookings</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        @if($member->bookings->count() > 0)
                            <div class="space-y-3">
                                @foreach($member->bookings->take(3) as $booking)
                                <div class="flex justify-between items-center text-sm">
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $booking->trainer->name }}</div>
                                        <div class="text-gray-500">{{ $booking->booking_date->format('M d') }}</div>
                                    </div>
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        @if($booking->status == 'confirmed') bg-green-100 text-green-800
                                        @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500 text-center">No bookings yet</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection