@extends('layouts.app')

@section('title', 'Book Session - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center space-x-3 mb-2">
                <a href="{{ route('member.bookings.index') }}" class="text-gray-600 hover:text-gray-900 transition">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Book a Session</h1>
            </div>
            <p class="text-sm text-gray-600">Schedule a training session with an expert trainer</p>
        </div>

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg flex items-center shadow-sm">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="glass-card rounded-xl p-6">
            <form action="{{ route('member.bookings.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Trainer Selection -->
                <div class="glass-card rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-user-tie text-orange-600 mr-2"></i>
                        Select Trainer
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($trainers as $trainer)
                        <label class="relative flex items-start p-4 cursor-pointer glass-card rounded-lg hover:bg-blue-50 transition border-2 border-transparent hover:border-orange-200">
                            <div class="flex items-center h-5">
                                <input type="radio" name="trainer_id" value="{{ $trainer->id }}" required
                                       {{ old('trainer_id') == $trainer->id ? 'checked' : '' }}
                                       class="focus:ring-orange-500 h-4 w-4 text-orange-600 border-gray-300">
                            </div>
                            <div class="ml-3">
                                <span class="block text-sm font-medium text-gray-900">{{ $trainer->name }}</span>
                                <span class="block text-sm text-gray-500">{{ $trainer->specialization }}</span>
                                <span class="block text-xs text-orange-600 mt-1">₱{{ number_format($trainer->hourly_rate, 2) }}/hr</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('trainer_id')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Session Details -->
                <div class="glass-card rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-clock text-green-600 mr-2"></i>
                        Session Details
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="session_type" class="block text-sm font-semibold text-gray-700 mb-2">Session Type <span class="text-red-500">*</span></label>
                            <select name="session_type" id="session_type" required
                                    class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all @error('session_type') ring-2 ring-red-500 @enderror">
                                <option value="">Select Type</option>
                                <option value="personal_training" {{ old('session_type') == 'personal_training' ? 'selected' : '' }}>Personal Training (Standard Rate)</option>
                                <option value="group_session" {{ old('session_type') == 'group_session' ? 'selected' : '' }}>Group Session (40% Off)</option>
                                <option value="consultation" {{ old('session_type') == 'consultation' ? 'selected' : '' }}>Consultation (50% Off)</option>
                            </select>
                            @error('session_type')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="booking_date" class="block text-sm font-semibold text-gray-700 mb-2">Date <span class="text-red-500">*</span></label>
                            <input type="date" name="booking_date" id="booking_date" required
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   value="{{ old('booking_date') }}"
                                   class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all @error('booking_date') ring-2 ring-red-500 @enderror">
                            @error('booking_date')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="start_time" class="block text-sm font-semibold text-gray-700 mb-2">Start Time <span class="text-red-500">*</span></label>
                            <input type="time" name="start_time" id="start_time" required
                                   value="{{ old('start_time') }}"
                                   class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all @error('start_time') ring-2 ring-red-500 @enderror">
                            @error('start_time')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_time" class="block text-sm font-semibold text-gray-700 mb-2">End Time <span class="text-red-500">*</span></label>
                            <input type="time" name="end_time" id="end_time" required
                                   value="{{ old('end_time') }}"
                                   class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all @error('end_time') ring-2 ring-red-500 @enderror">
                            @error('end_time')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Notes (Optional)</label>
                            <textarea name="notes" id="notes" rows="3"
                                      placeholder="Any specific goals or injuries the trainer should know about?"
                                      class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="glass-card rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-credit-card text-purple-600 mr-2"></i>
                        Payment Method
                    </h3>

                    <div>
                        <label for="payment_method" class="block text-sm font-semibold text-gray-700 mb-2">How would you like to pay? <span class="text-red-500">*</span></label>
                        <select name="payment_method" id="payment_method" required
                                class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all @error('payment_method') ring-2 ring-red-500 @enderror">
                            <option value="">Select payment method</option>
                            <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>💵 Cash</option>
                            <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>💳 Credit Card</option>
                            <option value="debit_card" {{ old('payment_method') == 'debit_card' ? 'selected' : '' }}>💳 Debit Card</option>
                            <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>🏦 Bank Transfer</option>
                            <option value="online" {{ old('payment_method') == 'online' ? 'selected' : '' }}>🌐 Online Payment</option>
                            <option value="face_to_face" {{ old('payment_method') == 'face_to_face' ? 'selected' : '' }}>🤝 Face to Face</option>
                            <option value="mobile_money" {{ old('payment_method') == 'mobile_money' ? 'selected' : '' }}>📱 Mobile Money (GCash/PayMaya)</option>
                            <option value="check" {{ old('payment_method') == 'check' ? 'selected' : '' }}>📝 Check</option>
                            <option value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>👛 E-Wallet (PayPal/Stripe)</option>
                        </select>
                        @error('payment_method')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <a href="{{ route('member.bookings.index') }}" 
                       class="px-6 py-3 glass-card text-gray-700 font-medium rounded-lg hover:bg-white hover:bg-opacity-60 transition">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 text-white font-medium rounded-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <i class="fas fa-check mr-2"></i>Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Simple script to auto-set end time to 1 hour after start time
    document.getElementById('start_time')?.addEventListener('change', function(e) {
        const startTime = e.target.value;
        if(startTime) {
            const [hours, minutes] = startTime.split(':');
            const date = new Date();
            date.setHours(parseInt(hours) + 1);
            date.setMinutes(parseInt(minutes));
            
            const endHours = String(date.getHours()).padStart(2, '0');
            const endMinutes = String(date.getMinutes()).padStart(2, '0');
            
            document.getElementById('end_time').value = `${endHours}:${endMinutes}`;
        }
    });
</script>
@endsection
