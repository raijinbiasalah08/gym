@extends('layouts.app')

@section('title', 'My Bookings - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">My Bookings</h1>
            <a href="{{ route('member.bookings.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i>New Booking
            </a>
        </div>

        @if(session('success'))
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-md">
            @if($bookings->count() > 0)
                <ul class="divide-y divide-gray-200">
                    @foreach($bookings as $booking)
                    <li class="px-6 py-4 hover:bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-calendar-alt text-2xl text-blue-600"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        Session with {{ $booking->trainer->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }} 
                                        at {{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }} - 
                                        {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        Type: {{ ucfirst(str_replace('_', ' ', $booking->session_type)) }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($booking->status == 'confirmed') bg-green-100 text-green-800
                                    @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($booking->status == 'completed') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                                <span class="text-sm font-medium text-gray-900">
                                    ${{ number_format($booking->price, 2) }}
                                </span>
                                <div class="flex space-x-2">
                                    <a href="{{ route('member.bookings.show', $booking) }}" 
                                       class="text-blue-600 hover:text-blue-900 text-sm">
                                        View
                                    </a>
                                    @if(in_array($booking->status, ['pending', 'confirmed']))
                                    <form action="{{ route('member.bookings.cancel', $booking) }}" method="POST" 
                                          onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm">
                                            Cancel
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                
                <!-- Pagination -->
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $bookings->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-calendar-times text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900">No bookings yet</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Get started by booking your first training session.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('member.bookings.create') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i>Book a Session
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection