@extends('layouts.app')

@section('title', 'Booking Details - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center space-x-3 mb-2">
                <a href="{{ route('member.bookings.index') }}" class="text-gray-600 hover:text-gray-900 transition">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Booking Details</h1>
            </div>
            <p class="text-sm text-gray-600">View complete information about your session</p>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center shadow-sm">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg flex items-center shadow-sm">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="glass-card rounded-xl overflow-hidden">
            <!-- Status Banner -->
            <div class="px-6 py-4 border-b border-gray-200 border-opacity-50 flex justify-between items-center
                @if($booking->status == 'confirmed') bg-green-50 bg-opacity-50
                @elseif($booking->status == 'pending') bg-yellow-50 bg-opacity-50
                @elseif($booking->status == 'cancelled') bg-red-50 bg-opacity-50
                @else bg-gray-50 bg-opacity-50 @endif">
                
                <div class="flex items-center">
                    <span class="text-sm font-medium text-gray-500 mr-2">Status:</span>
                    @if($booking->status == 'confirmed')
                        <span class="flex items-center text-green-700 font-bold">
                            <i class="fas fa-check-circle mr-2"></i> Confirmed
                        </span>
                    @elseif($booking->status == 'pending')
                        <span class="flex items-center text-yellow-700 font-bold">
                            <i class="fas fa-clock mr-2"></i> Pending Approval
                        </span>
                    @elseif($booking->status == 'cancelled')
                        <span class="flex items-center text-red-700 font-bold">
                            <i class="fas fa-times-circle mr-2"></i> Cancelled
                        </span>
                    @else
                        <span class="flex items-center text-gray-700 font-bold">
                            {{ ucfirst($booking->status) }}
                        </span>
                    @endif
                </div>

                <span class="text-sm text-gray-500">
                    ID: #{{ $booking->id }}
                </span>
            </div>

            <div class="p-6 space-y-8">
                <!-- Trainer Info -->
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="h-16 w-16 rounded-full bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center text-white text-2xl font-bold shadow-md">
                            {{ substr($booking->trainer->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="ml-5">
                        <h3 class="text-xl font-bold text-gray-900">{{ $booking->trainer->name }}</h3>
                        <p class="text-orange-600 font-medium">{{ $booking->trainer->specialization }}</p>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <i class="fas fa-envelope mr-2 w-4"></i> {{ $booking->trainer->email }}
                        </div>
                        <div class="mt-1 flex items-center text-sm text-gray-500">
                            <i class="fas fa-phone mr-2 w-4"></i> {{ $booking->trainer->phone ?? 'N/A' }}
                        </div>
                    </div>
                </div>

                <hr class="border-gray-200 border-opacity-50">

                <!-- Session Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-3">Session Info</h4>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-xs text-gray-500">Type</dt>
                                <dd class="text-base font-medium text-gray-900 capitalize">
                                    {{ str_replace('_', ' ', $booking->session_type) }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500">Price</dt>
                                <dd class="text-base font-medium text-gray-900">
                                    ₱{{ number_format($booking->price, 2) }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-3">Timing</h4>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-xs text-gray-500">Date</dt>
                                <dd class="text-base font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('l, F j, Y') }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500">Time</dt>
                                <dd class="text-base font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} - 
                                    {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                @if($booking->notes)
                <div class="bg-blue-50 bg-opacity-50 rounded-lg p-4 border border-orange-100">
                    <h4 class="text-sm font-bold text-blue-800 mb-2">Notes</h4>
                    <p class="text-sm text-blue-900">{{ $booking->notes }}</p>
                </div>
                @endif

                <!-- Actions -->
                @if(in_array($booking->status, ['pending', 'confirmed']))
                <div class="flex justify-end pt-4 border-t border-gray-200 border-opacity-50">
                    <form action="{{ route('member.bookings.cancel', $booking) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to cancel this booking? This action cannot be undone.')">
                        @csrf
                        @method('POST')
                        <button type="submit" 
                                class="px-6 py-3 bg-red-50 text-red-700 font-medium rounded-lg hover:bg-red-100 transition flex items-center">
                            <i class="fas fa-times-circle mr-2"></i>Cancel Booking
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
