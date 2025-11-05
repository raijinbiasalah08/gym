@extends('layouts.app')

@section('title', 'Record Payment - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Record Payment</h1>

        <div class="mt-6 bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('admin.payments.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Member Selection -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Member Information</h3>
                        </div>

                        <div class="md:col-span-2">
                            <label for="member_id" class="block text-sm font-medium text-gray-700">Select Member *</label>
                            <select name="member_id" id="member_id" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Select a member</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                        {{ $member->name }} - {{ $member->email }} ({{ ucfirst($member->membership_type) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('member_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Payment Details -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Details</h3>
                        </div>

                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700">Amount ($) *</label>
                            <input type="number" name="amount" id="amount" required min="0" step="0.01"
                                   value="{{ old('amount') }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('amount')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method *</label>
                            <select name="payment_method" id="payment_method" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Select method</option>
                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>Card</option>
                                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="online" {{ old('payment_method') == 'online' ? 'selected' : '' }}>Online</option>
                            </select>
                            @error('payment_method')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="payment_date" class="block text-sm font-medium text-gray-700">Payment Date *</label>
                            <input type="date" name="payment_date" id="payment_date" required
                                   value="{{ old('payment_date', now()->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('payment_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date *</label>
                            <input type="date" name="due_date" id="due_date" required
                                   value="{{ old('due_date') }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('due_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Membership Details -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Membership Details</h3>
                        </div>

                        <div>
                            <label for="membership_type" class="block text-sm font-medium text-gray-700">Membership Type *</label>
                            <select name="membership_type" id="membership_type" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="basic" {{ old('membership_type') == 'basic' ? 'selected' : '' }}>Basic</option>
                                <option value="premium" {{ old('membership_type') == 'premium' ? 'selected' : '' }}>Premium</option>
                                <option value="vip" {{ old('membership_type') == 'vip' ? 'selected' : '' }}>VIP</option>
                            </select>
                            @error('membership_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="period_start" class="block text-sm font-medium text-gray-700">Period Start *</label>
                            <input type="date" name="period_start" id="period_start" required
                                   value="{{ old('period_start') }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('period_start')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="period_end" class="block text-sm font-medium text-gray-700">Period End *</label>
                            <input type="date" name="period_end" id="period_end" required
                                   value="{{ old('period_end') }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('period_end')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description *</label>
                            <textarea name="description" id="description" rows="3" required
                                      placeholder="e.g., Monthly membership fee, Personal training sessions, etc."
                                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.payments.index') }}" 
                           class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Record Payment
                        </button>
                    </div>
                </form>
            </div>
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