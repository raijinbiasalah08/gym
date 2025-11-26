@extends('layouts.app')

@section('title', $exerciseName . ' - Coming Soon')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('trainer.dashboard') }}" class="inline-flex items-center text-gray-600 hover:text-orange-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Dashboard
            </a>
        </div>

        <!-- Coming Soon Card -->
        <div class="neuro-card p-8 text-center">
            <div class="mb-6">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-orange-100 to-red-100 rounded-full mb-4">
                    <i class="fas fa-dumbbell text-5xl text-orange-600"></i>
                </div>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-3">{{ $exerciseName }}</h1>
            
            <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 mb-6">
                <i class="fas fa-clock mr-2"></i>
                Coming Soon
            </div>
            
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                Detailed information for this exercise is currently being prepared. We're working on adding comprehensive instructions, equipment requirements, muscle group targeting, and safety tips.
            </p>

            <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-lg p-6 mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-3">What's Coming:</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                        <span class="text-gray-700">Step-by-step instructions</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                        <span class="text-gray-700">Equipment requirements</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                        <span class="text-gray-700">Muscle group targeting</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                        <span class="text-gray-700">Form tips & safety notes</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                        <span class="text-gray-700">Difficulty level</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                        <span class="text-gray-700">Video demonstrations</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-center gap-4">
                <a href="{{ route('trainer.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 text-white font-medium rounded-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Exercise Library
                </a>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i>
                    In the meantime, you can explore other exercises in the library or consult with a certified trainer for guidance on this exercise.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
