@extends('layouts.app')

@section('title', 'Booking Details - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Booking Details</h1>
            <a href="{{ route('member.bookings.index') }}" 
               class="text-blue-600 hover:text-blue-500">
                &larr; Back to Bookings
            </a>
        </div>

        <div class="mt-6 bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Session Information -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Session Information</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Trainer</dt>
                                <dd class="text-sm text-gray-900">{{ $booking->trainer->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Session Type</dt>
                                <dd class="text-sm text-gray-900 capitalize">
                                    {{ str_replace('_', ' ', $booking->session_type) }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Date & Time</dt>
                                <dd class="text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('F d, Y') }}<br>
                                    {{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }} - 
                                    {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Duration</dt>
                                <dd class="text-sm text-gray-900">
                                    @php
                                        $start = \Carbon\Carbon::parse($booking->start_time);
                                        $end = \Carbon\Carbon::parse($booking->end_time);
                                        $duration = $start->diffInMinutes($end);
                                    @endphp
                                    {{ floor($duration / 60) }}h {{ $duration % 60 }}m
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Booking Details -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Booking Details</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="text-sm">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        @if($booking->status == 'confirmed') bg-green-100 text-green-800
                                        @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($booking->status == 'completed') bg-blue-100 text-blue-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Price</dt>
                                <dd class="text-sm text-gray-900">${{ number_format($booking->price, 2) }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Booked On</dt>
                                <dd class="text-sm text-gray-900">
                                    {{ $booking->created_at->format('F d, Y g:i A') }}
                                </dd>
                            </div>
                            @if($booking->notes)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Notes</dt>
                                <dd class="text-sm text-gray-900">{{ $booking->notes }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>
                </div>

                <!-- Actions -->
                @if(in_array($booking->status, ['pending', 'confirmed']))
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <form action="{{ route('member.bookings.cancel', $booking) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">
                            <i class="fas fa-times mr-2"></i>Cancel Booking
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection