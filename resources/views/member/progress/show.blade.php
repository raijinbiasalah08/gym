@extends('layouts.app')

@section('title', 'Progress Details - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center space-x-3 mb-2">
                <a href="{{ route('member.progress.index') }}" class="text-gray-600 hover:text-gray-900 transition">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Progress Details</h1>
            </div>
            <p class="text-sm text-gray-600">Detailed view of your measurements on {{ \Carbon\Carbon::parse($progress->record_date)->format('F d, Y') }}</p>
        </div>

        <div class="glass-card rounded-xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 border-opacity-50 flex justify-between items-center bg-blue-50 bg-opacity-30">
                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                    <i class="fas fa-calendar-check text-orange-600 mr-2"></i>
                    Record Date: {{ \Carbon\Carbon::parse($progress->record_date)->format('M d, Y') }}
                </h3>
                <span class="text-sm text-gray-500">
                    ID: #{{ $progress->id }}
                </span>
            </div>

            <div class="p-6 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Basic Measurements -->
                    <div class="glass-card rounded-lg p-6 bg-white bg-opacity-40">
                        <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-weight text-green-600 mr-2"></i>
                            Basic Stats
                        </h4>
                        
                        <dl class="space-y-4">
                            <div class="flex justify-between items-center border-b border-gray-200 border-opacity-50 pb-2">
                                <dt class="text-sm font-medium text-gray-600">Weight</dt>
                                <dd class="text-lg font-bold text-gray-900">{{ $progress->weight }} kg</dd>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-200 border-opacity-50 pb-2">
                                <dt class="text-sm font-medium text-gray-600">Height</dt>
                                <dd class="text-lg font-bold text-gray-900">{{ $progress->height }} cm</dd>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-200 border-opacity-50 pb-2">
                                <dt class="text-sm font-medium text-gray-600">BMI</dt>
                                <dd class="text-lg font-bold text-gray-900">{{ $progress->bmi ?? 'N/A' }}</dd>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-200 border-opacity-50 pb-2">
                                <dt class="text-sm font-medium text-gray-600">Body Fat</dt>
                                <dd class="text-lg font-bold text-gray-900">{{ $progress->body_fat_percentage }}%</dd>
                            </div>
                            <div class="flex justify-between items-center pt-2">
                                <dt class="text-sm font-medium text-gray-600">Muscle Mass</dt>
                                <dd class="text-lg font-bold text-gray-900">{{ $progress->muscle_mass }} kg</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Body Measurements -->
                    <div class="glass-card rounded-lg p-6 bg-white bg-opacity-40">
                        <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-ruler-combined text-purple-600 mr-2"></i>
                            Body Measurements
                        </h4>
                        
                        <dl class="space-y-4">
                            <div class="flex justify-between items-center border-b border-gray-200 border-opacity-50 pb-2">
                                <dt class="text-sm font-medium text-gray-600">Chest</dt>
                                <dd class="text-lg font-bold text-gray-900">{{ $progress->chest_measurement }} cm</dd>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-200 border-opacity-50 pb-2">
                                <dt class="text-sm font-medium text-gray-600">Waist</dt>
                                <dd class="text-lg font-bold text-gray-900">{{ $progress->waist_measurement }} cm</dd>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-200 border-opacity-50 pb-2">
                                <dt class="text-sm font-medium text-gray-600">Hips</dt>
                                <dd class="text-lg font-bold text-gray-900">{{ $progress->hip_measurement }} cm</dd>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-200 border-opacity-50 pb-2">
                                <dt class="text-sm font-medium text-gray-600">Arms</dt>
                                <dd class="text-lg font-bold text-gray-900">{{ $progress->arm_measurement }} cm</dd>
                            </div>
                            <div class="flex justify-between items-center pt-2">
                                <dt class="text-sm font-medium text-gray-600">Thighs</dt>
                                <dd class="text-lg font-bold text-gray-900">{{ $progress->thigh_measurement }} cm</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Notes -->
                @if($progress->notes)
                <div class="glass-card rounded-lg p-6 bg-yellow-50 bg-opacity-30 border border-yellow-100">
                    <h4 class="text-lg font-bold text-yellow-800 mb-2 flex items-center">
                        <i class="fas fa-sticky-note mr-2"></i> Notes
                    </h4>
                    <p class="text-gray-800 leading-relaxed">{{ $progress->notes }}</p>
                </div>
                @endif

                <!-- Footer -->
                <div class="pt-4 border-t border-gray-200 border-opacity-50 flex justify-between items-center text-sm text-gray-500">
                    <span>
                        <i class="far fa-clock mr-1"></i>
                        Recorded on {{ $progress->created_at->format('M d, Y \\a\\t h:i A') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection