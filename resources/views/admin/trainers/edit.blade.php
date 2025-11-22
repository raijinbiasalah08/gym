@extends('layouts.app')

@section('title', 'Edit Trainer - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <div class="flex items-center space-x-3 mb-2">
                <a href="{{ route('admin.trainers.show', $trainer) }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Edit Trainer</h1>
            </div>
            <p class="text-sm text-gray-600">Update {{ $trainer->name }}'s information</p>
        </div>

        <form action="{{ route('admin.trainers.update', $trainer) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="glass-card rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-user text-green-600 mr-2"></i>
                    Personal Information
                </h3>
                
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" required value="{{ old('name', $trainer->name) }}"
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all @error('name') ring-2 ring-red-500 @enderror">
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
                        <input type="email" name="email" id="email" required value="{{ old('email', $trainer->email) }}"
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all @error('email') ring-2 ring-red-500 @enderror">
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
                        <input type="tel" name="phone" id="phone" required value="{{ old('phone', $trainer->phone) }}"
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all @error('phone') ring-2 ring-red-500 @enderror">
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
                        <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $trainer->date_of_birth?->format('Y-m-d')) }}"
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                    </div>

                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                            Address
                        </label>
                        <textarea name="address" id="address" rows="3"
                                  class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">{{ old('address', $trainer->address) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-dumbbell text-purple-600 mr-2"></i>
                    Professional Information
                </h3>
                
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="specialization" class="block text-sm font-semibold text-gray-700 mb-2">
                            Specialization <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="specialization" id="specialization" required value="{{ old('specialization', $trainer->specialization) }}"
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all @error('specialization') ring-2 ring-red-500 @enderror">
                        @error('specialization')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="experience_years" class="block text-sm font-semibold text-gray-700 mb-2">
                            Years of Experience
                        </label>
                        <input type="number" name="experience_years" id="experience_years" min="0" value="{{ old('experience_years', $trainer->experience_years) }}"
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                    </div>

                    <div class="md:col-span-2">
                        <label for="certifications" class="block text-sm font-semibold text-gray-700 mb-2">
                            Certifications
                        </label>
                        <textarea name="certifications" id="certifications" rows="3"
                                  class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">{{ old('certifications', $trainer->certifications) }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label for="bio" class="block text-sm font-semibold text-gray-700 mb-2">
                            Bio
                        </label>
                        <textarea name="bio" id="bio" rows="4"
                                  class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">{{ old('bio', $trainer->bio) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-toggle-on text-blue-600 mr-2"></i>
                    Account Status
                </h3>
                
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           {{ old('is_active', $trainer->is_active) ? 'checked' : '' }}
                           class="h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-3 block text-sm font-medium text-gray-900">
                        Active Trainer
                    </label>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.trainers.show', $trainer) }}" 
                   class="px-6 py-3 glass-card text-gray-700 font-medium rounded-lg hover:bg-white hover:bg-opacity-60 transition">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-medium rounded-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <i class="fas fa-save mr-2"></i>Update Trainer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection