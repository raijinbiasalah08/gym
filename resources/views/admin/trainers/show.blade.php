@extends('layouts.app')

@section('title', 'Trainer Details - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Trainer Details</h1>
                <p class="text-sm text-gray-600 mt-1">Complete trainer profile and activity</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.trainers.index') }}" 
                   class="px-4 py-2 glass-card text-gray-700 font-medium rounded-lg hover:bg-white hover:bg-opacity-60 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
                <a href="{{ route('admin.trainers.edit', $trainer) }}" 
                   class="px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white font-medium rounded-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <i class="fas fa-edit mr-2"></i>Edit Trainer
                </a>
            </div>
        </div>

        <!-- Trainer Header Card -->
        <div class="glass-card rounded-xl p-6 mb-6">
            <div class="flex items-center space-x-6">
                <div class="flex-shrink-0">
                    <div class="h-24 w-24 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center shadow-lg">
                        <span class="text-white font-bold text-4xl">{{ substr($trainer->name, 0, 1) }}</span>
                    </div>
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $trainer->name }}</h2>
                    <p class="text-gray-600 mt-1">{{ $trainer->email }}</p>
                    <div class="flex items-center space-x-3 mt-3">
                        @if($trainer->is_active)
                            <span class="bg-gradient-to-r from-green-500 to-green-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                                Active
                            </span>
                        @else
                            <span class="bg-gradient-to-r from-red-500 to-red-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                                Inactive
                            </span>
                        @endif
                        <span class="bg-gradient-to-r from-purple-500 to-purple-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                            {{ $trainer->specialization ?? 'General' }}
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
                            <i class="fas fa-users text-2xl text-white"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-gray-900">{{ $clientsCount }}</div>
                        <div class="text-sm text-gray-600">Total Clients</div>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-xl p-6 hover:shadow-lg transition">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-xl bg-gradient-to-br from-green-500 to-green-600 p-3 shadow-lg">
                            <i class="fas fa-calendar-check text-2xl text-white"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-gray-900">{{ $sessionsCount }}</div>
                        <div class="text-sm text-gray-600">Total Sessions</div>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-xl p-6 hover:shadow-lg transition">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 p-3 shadow-lg">
                            <i class="fas fa-clipboard-list text-2xl text-white"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-gray-900">{{ $workoutPlansCount }}</div>
                        <div class="text-sm text-gray-600">Workout Plans</div>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-xl p-6 hover:shadow-lg transition">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 p-3 shadow-lg">
                            <i class="fas fa-star text-2xl text-white"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-2xl font-bold text-gray-900">{{ $trainer->experience_years ?? 0 }}</div>
                        <div class="text-sm text-gray-600">Years Experience</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Personal Information -->
            <div class="glass-card rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-user text-green-600 mr-2"></i>
                    Personal Information
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Full Name</label>
                        <p class="mt-1 text-gray-900">{{ $trainer->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Email Address</label>
                        <p class="mt-1 text-gray-900">{{ $trainer->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Phone Number</label>
                        <p class="mt-1 text-gray-900">{{ $trainer->phone ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Date of Birth</label>
                        <p class="mt-1 text-gray-900">{{ $trainer->date_of_birth ? $trainer->date_of_birth->format('M d, Y') . ' (' . $trainer->date_of_birth->age . ' years)' : 'Not provided' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Address</label>
                        <p class="mt-1 text-gray-900">{{ $trainer->address ?? 'Not provided' }}</p>
                    </div>
                </div>
            </div>

            <!-- Professional Information -->
            <div class="glass-card rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-dumbbell text-purple-600 mr-2"></i>
                    Professional Information
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Specialization</label>
                        <p class="mt-1 text-gray-900">{{ $trainer->specialization ?? 'General' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Years of Experience</label>
                        <p class="mt-1 text-gray-900">{{ $trainer->experience_years ?? 0 }} years</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Certifications</label>
                        <p class="mt-1 text-gray-900">{{ $trainer->certifications ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Bio</label>
                        <p class="mt-1 text-gray-900">{{ $trainer->bio ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-600">Joined Date</label>
                        <p class="mt-1 text-gray-900">{{ $trainer->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Recent Sessions -->
            <div class="glass-card rounded-xl p-6 lg:col-span-2">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
                    Recent Sessions
                </h3>
                @if(isset($trainer->bookings) && $trainer->bookings->count() > 0)
                    <div class="space-y-3">
                        @foreach($trainer->bookings->take(5) as $booking)
                        <div class="flex justify-between items-center p-4 bg-white bg-opacity-40 rounded-lg hover:bg-opacity-60 transition">
                            <div class="flex items-center space-x-4">
                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center shadow-md">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $booking->member->name ?? 'No Member' }}</p>
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
                        <p>No recent sessions found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection