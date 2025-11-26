@extends('layouts.app')

@section('title', 'Booking Details - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Booking Details</h1>
            <div class="space-x-2">
                <a href="{{ route('trainer.bookings.index') }}" 
                   class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Bookings
                </a>
            </div>
        </div>

        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Session Information -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900">Session Information</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-medium text-gray-500">Member</label>
                                <div class="mt-1 flex items-center">
                                    <i class="fas fa-user-circle text-2xl text-gray-400 mr-3"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $booking->member->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $booking->member->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-500">Session Type</label>
                                <p class="mt-1 text-sm text-gray-900 capitalize">
                                    {{ str_replace('_', ' ', $booking->session_type) }}
                                </p>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-500">Date & Time</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('l, F d, Y') }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }} - 
                                    {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}
                                </p>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-500">Duration</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $booking->duration }} minutes</p>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Details -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900">Booking Details</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-medium text-gray-500">Status</label>
                                <p class="mt-1">
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                        @if($booking->status == 'confirmed') bg-green-100 text-green-800
                                        @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($booking->status == 'completed') bg-blue-100 text-blue-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </p>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-500">Price</label>
                                <p class="mt-1 text-2xl font-bold text-gray-900">₱{{ number_format($booking->price, 2) }}</p>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-500">Booked On</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ $booking->created_at->format('F d, Y \\a\\t g:i A') }}
                                </p>
                            </div>

                            @if($booking->notes)
                            <div>
                                <label class="text-sm font-medium text-gray-500">Member Notes</label>
                                <p class="mt-1 text-sm text-gray-900 bg-gray-50 p-3 rounded">{{ $booking->notes }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Member Information -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Member Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Phone</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $booking->member->phone ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Membership Type</label>
                            <p class="mt-1 text-sm text-gray-900 capitalize">{{ $booking->member->membership_type }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Membership Status</label>
                            <p class="mt-1">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($booking->member->membership_status === 'active') bg-green-100 text-green-800
                                    @elseif($booking->member->membership_status === 'expiring_soon') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ str_replace('_', ' ', $booking->member->membership_status) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Membership Expiry</label>
                            <p class="mt-1 text-sm text-gray-900">
                                {{ $booking->member->membership_expiry?->format('M d, Y') ?? 'Not set' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                @if(in_array($booking->status, ['pending', 'confirmed']))
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Manage Booking</h3>
                    <div class="flex space-x-4">
                        @if($booking->status == 'pending')
                        <form action="{{ route('trainer.bookings.update-status', $booking) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="confirmed">
                            <button type="submit" 
                                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
                                <i class="fas fa-check mr-2"></i>Confirm Booking
                            </button>
                        </form>
                        @endif

                        @if($booking->status == 'confirmed')
                        <form action="{{ route('trainer.bookings.update-status', $booking) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" 
                                    class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700 transition">
                                <i class="fas fa-flag-checkered mr-2"></i>Mark as Completed
                            </button>
                        </form>
                        @endif

                        @if(in_array($booking->status, ['pending', 'confirmed']))
                        <form action="{{ route('trainer.bookings.update-status', $booking) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="cancelled">
                            <button type="submit" 
                                    class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">
                                <i class="fas fa-times mr-2"></i>Cancel Booking
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection