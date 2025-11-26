@extends('layouts.app')

@section('title', 'Add New Member - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center space-x-3 mb-2">
                <a href="{{ route('admin.members.index') }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Add New Member</h1>
            </div>
            <p class="text-sm text-gray-600">Create a new member account with membership details</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.members.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Personal Information -->
            <div class="glass-card rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-user text-orange-600 mr-2"></i>
                    Personal Information
                </h3>
                
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" required
                               value="{{ old('name') }}"
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all @error('name') ring-2 ring-red-500 @enderror">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" required
                               value="{{ old('email') }}"
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all @error('email') ring-2 ring-red-500 @enderror">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" name="phone" id="phone" required
                               value="{{ old('phone') }}"
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all @error('phone') ring-2 ring-red-500 @enderror">
                        @error('phone')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="date_of_birth" class="block text-sm font-semibold text-gray-700 mb-2">
                            Date of Birth
                        </label>
                        <input type="date" name="date_of_birth" id="date_of_birth"
                               value="{{ old('date_of_birth') }}"
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">
                        @error('date_of_birth')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                            Address
                        </label>
                        <textarea name="address" id="address" rows="3"
                                  class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Membership Information -->
            <div class="glass-card rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-id-card text-purple-600 mr-2"></i>
                    Membership Information
                </h3>
                
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="membership_type" class="block text-sm font-semibold text-gray-700 mb-2">
                            Membership Type <span class="text-red-500">*</span>
                        </label>
                        <select name="membership_type" id="membership_type" required
                                class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all @error('membership_type') ring-2 ring-red-500 @enderror">
                            <option value="">Select Membership Type</option>
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
                        <label for="membership_expiry" class="block text-sm font-semibold text-gray-700 mb-2">
                            Membership Expiry <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="membership_expiry" id="membership_expiry" required
                               value="{{ old('membership_expiry') }}"
                               min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}"
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all @error('membership_expiry') ring-2 ring-red-500 @enderror">
                        @error('membership_expiry')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Health Information -->
            <div class="glass-card rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-heartbeat text-red-600 mr-2"></i>
                    Health Information
                </h3>
                
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <div>
                        <label for="height" class="block text-sm font-semibold text-gray-700 mb-2">
                            Height (cm)
                        </label>
                        <input type="number" name="height" id="height" step="0.1"
                               value="{{ old('height') }}"
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">
                        @error('height')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="weight" class="block text-sm font-semibold text-gray-700 mb-2">
                            Weight (kg)
                        </label>
                        <input type="number" name="weight" id="weight" step="0.1"
                               value="{{ old('weight') }}"
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">
                        @error('weight')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="emergency_contact" class="block text-sm font-semibold text-gray-700 mb-2">
                            Emergency Contact
                        </label>
                        <input type="text" name="emergency_contact" id="emergency_contact"
                               value="{{ old('emergency_contact') }}"
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">
                        @error('emergency_contact')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-3">
                        <label for="health_notes" class="block text-sm font-semibold text-gray-700 mb-2">
                            Health Notes
                        </label>
                        <textarea name="health_notes" id="health_notes" rows="3"
                                  class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">{{ old('health_notes') }}</textarea>
                        @error('health_notes')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Account Information -->
            <div class="glass-card rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-lock text-green-600 mr-2"></i>
                    Account Information
                </h3>
                
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password" id="password" required
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all @error('password') ring-2 ring-red-500 @enderror">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                            Confirm Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.members.index') }}" 
                   class="px-6 py-3 glass-card text-gray-700 font-medium rounded-lg hover:bg-white hover:bg-opacity-60 transition">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 text-white font-medium rounded-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <i class="fas fa-user-plus mr-2"></i>Create Member
                </button>
            </div>
        </form>
    </div>
</div>
@endsection