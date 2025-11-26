@extends('layouts.app')

@section('title', 'Record Payment - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center space-x-3 mb-2">
                <a href="{{ route('admin.payments.index') }}" class="text-gray-600 hover:text-gray-900 transition">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Record Payment</h1>
            </div>
            <p class="text-sm text-gray-600">Create a new payment record for a member</p>
        </div>

        <div class="glass-card rounded-xl p-6">
            <form action="{{ route('admin.payments.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Member Selection -->
                <div class="glass-card rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-user text-orange-600 mr-2"></i>
                        Member Information
                    </h3>
                    
                    <div>
                        <label for="member_id" class="block text-sm font-semibold text-gray-700 mb-2">Select Member <span class="text-red-500">*</span></label>
                        <select name="member_id" id="member_id" required
                                class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all @error('member_id') ring-2 ring-red-500 @enderror">
                            <option value="">Select a member</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->name }} - {{ $member->email }} ({{ ucfirst($member->membership_type) }})
                                </option>
                            @endforeach
                        </select>
                        @error('member_id')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="glass-card rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-credit-card text-green-600 mr-2"></i>
                        Payment Details
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">Amount ($) <span class="text-red-500">*</span></label>
                            <input type="number" name="amount" id="amount" required min="0" step="0.01"
                                   value="{{ old('amount') }}"
                                   class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all @error('amount') ring-2 ring-red-500 @enderror">
                            @error('amount')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="payment_method" class="block text-sm font-semibold text-gray-700 mb-2">Payment Method <span class="text-red-500">*</span></label>
                            <select name="payment_method" id="payment_method" required
                                    class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all @error('payment_method') ring-2 ring-red-500 @enderror">
                                <option value="">Select method</option>
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

                        <div>
                            <label for="payment_date" class="block text-sm font-semibold text-gray-700 mb-2">Payment Date <span class="text-red-500">*</span></label>
                            <input type="date" name="payment_date" id="payment_date" required
                                   value="{{ old('payment_date', now()->format('Y-m-d')) }}"
                                   class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">
                            @error('payment_date')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="due_date" class="block text-sm font-semibold text-gray-700 mb-2">Due Date <span class="text-red-500">*</span></label>
                            <input type="date" name="due_date" id="due_date" required
                                   value="{{ old('due_date') }}"
                                   class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">
                            @error('due_date')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Membership Details -->
                <div class="glass-card rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-id-card text-purple-600 mr-2"></i>
                        Membership Details
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="membership_type" class="block text-sm font-semibold text-gray-700 mb-2">Membership Type <span class="text-red-500">*</span></label>
                            <select name="membership_type" id="membership_type" required
                                    class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all @error('membership_type') ring-2 ring-red-500 @enderror">
                                <option value="basic" {{ old('membership_type') == 'basic' ? 'selected' : '' }}>Basic</option>
                                <option value="premium" {{ old('membership_type') == 'premium' ? 'selected' : '' }}>Premium</option>
                                <option value="vip" {{ old('membership_type') == 'vip' ? 'selected' : '' }}>VIP</option>
                            </select>
                            @error('membership_type')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="period_start" class="block text-sm font-semibold text-gray-700 mb-2">Period Start <span class="text-red-500">*</span></label>
                            <input type="date" name="period_start" id="period_start" required
                                   value="{{ old('period_start') }}"
                                   class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">
                            @error('period_start')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="period_end" class="block text-sm font-semibold text-gray-700 mb-2">Period End <span class="text-red-500">*</span></label>
                            <input type="date" name="period_end" id="period_end" required
                                   value="{{ old('period_end') }}"
                                   class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">
                            @error('period_end')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="md:col-span-3">
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                            <textarea name="description" id="description" rows="3" required
                                      placeholder="e.g., Monthly membership fee, Personal training sessions, etc."
                                      class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <a href="{{ route('admin.payments.index') }}" 
                       class="px-6 py-3 glass-card text-gray-700 font-medium rounded-lg hover:bg-white hover:bg-opacity-60 transition">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 text-white font-medium rounded-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <i class="fas fa-save mr-2"></i>Record Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const periodStart = document.getElementById('period_start');
    const periodEnd = document.getElementById('period_end');
    
    // Set period start default to today
    if (!periodStart.value) {
        periodStart.value = new Date().toISOString().split('T')[0];
    }
    
    // Set period end default to 30 days from today
    if (!periodEnd.value) {
        const endDate = new Date();
        endDate.setDate(endDate.getDate() + 30);
        periodEnd.value = endDate.toISOString().split('T')[0];
    }
    
    // Set due date default to 7 days from today
    const dueDate = document.getElementById('due_date');
    if (!dueDate.value) {
        const due = new Date();
        due.setDate(due.getDate() + 7);
        dueDate.value = due.toISOString().split('T')[0];
    }
});
</script>
@endsection