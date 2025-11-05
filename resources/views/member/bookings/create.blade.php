@extends('layouts.app')

@section('title', 'Book a Session - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Book a Training Session</h1>

        @if(session('error'))
            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="mt-6 bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('member.bookings.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Trainer Selection -->
                        <div>
                            <label for="trainer_id" class="block text-sm font-medium text-gray-700">
                                Select Trainer *
                            </label>
                            <select id="trainer_id" name="trainer_id" required
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Choose a trainer</option>
                                @foreach($trainers as $trainer)
                                    <option value="{{ $trainer->id }}" 
                                            {{ old('trainer_id') == $trainer->id ? 'selected' : '' }}>
                                        {{ $trainer->name }} - {{ $trainer->specialization }} 
                                        (${{ number_format($trainer->hourly_rate, 2) }}/hour)
                                    </option>
                                @endforeach
                            </select>
                            @error('trainer_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Session Type -->
                        <div>
                            <label for="session_type" class="block text-sm font-medium text-gray-700">
                                Session Type *
                            </label>
                            <select id="session_type" name="session_type" required
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Select session type</option>
                                <option value="personal_training" {{ old('session_type') == 'personal_training' ? 'selected' : '' }}>
                                    Personal Training
                                </option>
                                <option value="group_session" {{ old('session_type') == 'group_session' ? 'selected' : '' }}>
                                    Group Session
                                </option>
                                <option value="consultation" {{ old('session_type') == 'consultation' ? 'selected' : '' }}>
                                    Consultation
                                </option>
                            </select>
                            @error('session_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Booking Date -->
                        <div>
                            <label for="booking_date" class="block text-sm font-medium text-gray-700">
                                Session Date *
                            </label>
                            <input type="date" id="booking_date" name="booking_date" required
                                   min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}"
                                   value="{{ old('booking_date') }}"
                                   class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('booking_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Start Time -->
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700">
                                Start Time *
                            </label>
                            <input type="time" id="start_time" name="start_time" required
                                   value="{{ old('start_time') }}"
                                   class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('start_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- End Time -->
                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700">
                                End Time *
                            </label>
                            <input type="time" id="end_time" name="end_time" required
                                   value="{{ old('end_time') }}"
                                   class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('end_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700">
                                Additional Notes
                            </label>
                            <textarea id="notes" name="notes" rows="3"
                                      class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                      placeholder="Any specific goals or requirements...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('member.bookings.index') }}" 
                           class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Book Session
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum time to current time + 1 hour for today's date
    const now = new Date();
    const minTime = now.getHours().toString().padStart(2, '0') + ':' + 
                   (now.getMinutes() + 60).toString().padStart(2, '0');
    
    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');
    const dateInput = document.getElementById('booking_date');
    
    // Update time validation when date changes
    dateInput.addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        const today = new Date();
        
        if (selectedDate.toDateString() === today.toDateString()) {
            startTimeInput.min = minTime;
        } else {
            startTimeInput.removeAttribute('min');
        }
    });
    
    // Update end time minimum when start time changes
    startTimeInput.addEventListener('change', function() {
        endTimeInput.min = this.value;
    });
});
</script>
@endsection