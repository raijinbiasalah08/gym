@extends('layouts.app')

@section('title', 'Edit Progress - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center space-x-3 mb-2">
                <a href="{{ route('trainer.progress.index') }}" class="text-gray-600 hover:text-gray-900 transition">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Edit Progress Record</h1>
            </div>
            <p class="text-sm text-gray-600">Update member progress metrics and measurements</p>
        </div>

        <div class="glass-card rounded-xl p-6">
            <form action="{{ route('trainer.progress.update', $progress) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Member Info (Read-only) -->
                <div class="bg-blue-50 bg-opacity-50 rounded-lg p-4 border border-blue-100">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold shadow-sm">
                                {{ substr($progress->member->name, 0, 1) }}
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-semibold text-gray-900">Member</h3>
                            <p class="text-sm text-gray-600">{{ $progress->member->name }} ({{ $progress->member->email }})</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Date -->
                    <div>
                        <label for="record_date" class="block text-sm font-semibold text-gray-700 mb-2">
                            Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="record_date" id="record_date" 
                               value="{{ old('record_date', $progress->record_date->format('Y-m-d')) }}" 
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('record_date') ring-2 ring-red-500 @enderror">
                        @error('record_date')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Basic Metrics -->
                    <div>
                        <label for="weight" class="block text-sm font-semibold text-gray-700 mb-2">
                            Weight (kg) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" step="0.1" name="weight" id="weight" 
                               value="{{ old('weight', $progress->weight) }}" 
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('weight') ring-2 ring-red-500 @enderror">
                        @error('weight')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="height" class="block text-sm font-semibold text-gray-700 mb-2">
                            Height (cm) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" step="0.1" name="height" id="height" 
                               value="{{ old('height', $progress->height) }}" 
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('height') ring-2 ring-red-500 @enderror">
                        @error('height')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="body_fat_percentage" class="block text-sm font-semibold text-gray-700 mb-2">
                            Body Fat %
                        </label>
                        <input type="number" step="0.1" name="body_fat_percentage" id="body_fat_percentage" 
                               value="{{ old('body_fat_percentage', $progress->body_fat_percentage) }}" 
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('body_fat_percentage') ring-2 ring-red-500 @enderror">
                        @error('body_fat_percentage')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="muscle_mass" class="block text-sm font-semibold text-gray-700 mb-2">
                            Muscle Mass (kg)
                        </label>
                        <input type="number" step="0.1" name="muscle_mass" id="muscle_mass" 
                               value="{{ old('muscle_mass', $progress->muscle_mass) }}" 
                               class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>
                </div>

                <div class="border-t border-gray-200 border-opacity-50 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-ruler-combined text-purple-600 mr-2"></i>
                        Body Measurements
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="chest_measurement" class="block text-sm font-semibold text-gray-700 mb-2">Chest (cm)</label>
                            <input type="number" step="0.1" name="chest_measurement" id="chest_measurement" 
                                   value="{{ old('chest_measurement', $progress->chest_measurement) }}" 
                                   class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>

                        <div>
                            <label for="waist_measurement" class="block text-sm font-semibold text-gray-700 mb-2">Waist (cm)</label>
                            <input type="number" step="0.1" name="waist_measurement" id="waist_measurement" 
                                   value="{{ old('waist_measurement', $progress->waist_measurement) }}" 
                                   class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>

                        <div>
                            <label for="hip_measurement" class="block text-sm font-semibold text-gray-700 mb-2">Hip (cm)</label>
                            <input type="number" step="0.1" name="hip_measurement" id="hip_measurement" 
                                   value="{{ old('hip_measurement', $progress->hip_measurement) }}" 
                                   class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>

                        <div>
                            <label for="arm_measurement" class="block text-sm font-semibold text-gray-700 mb-2">Arm (cm)</label>
                            <input type="number" step="0.1" name="arm_measurement" id="arm_measurement" 
                                   value="{{ old('arm_measurement', $progress->arm_measurement) }}" 
                                   class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>

                        <div>
                            <label for="thigh_measurement" class="block text-sm font-semibold text-gray-700 mb-2">Thigh (cm)</label>
                            <input type="number" step="0.1" name="thigh_measurement" id="thigh_measurement" 
                                   value="{{ old('thigh_measurement', $progress->thigh_measurement) }}" 
                                   class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                    <textarea name="notes" id="notes" rows="3" 
                              class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">{{ old('notes', $progress->notes) }}</textarea>
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <a href="{{ route('trainer.progress.index') }}" 
                       class="px-6 py-3 glass-card text-gray-700 font-medium rounded-lg hover:bg-white hover:bg-opacity-60 transition">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <i class="fas fa-save mr-2"></i>Update Progress
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
