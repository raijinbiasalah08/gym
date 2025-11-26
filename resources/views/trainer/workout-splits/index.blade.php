@extends('layouts.app')

@section('title', 'Workout Splits Guide - TitansGym')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">
                <i class="fas fa-calendar-week text-orange-600 mr-3"></i>Workout Splits Guide
            </h1>
            <p class="text-lg text-gray-600">Comprehensive breakdown of different training splits to help you design effective workout programs</p>
        </div>

        <!-- Full-Body Split -->
        <div class="neuro-card p-8 mb-8 animate-fade-in">
            <div class="flex items-start justify-between mb-6">
                <div class="flex items-center">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center mr-4 shadow-lg">
                        <i class="fas fa-dumbbell text-3xl text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Full-Body Split</h2>
                        <p class="text-sm text-gray-600 mt-1">Train all major muscle groups in one session</p>
                    </div>
                </div>
                <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Beginner Friendly</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Muscle Groups -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-users text-orange-600 mr-2"></i>Muscle Groups Trained
                    </h3>
                    <div class="space-y-2">
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Chest, Back, Shoulders</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Arms (Biceps & Triceps)</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Legs (Quads, Hamstrings, Glutes)</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span>Core & Abs</span>
                        </div>
                    </div>
                </div>

                <!-- Weekly Frequency -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-calendar-alt text-orange-600 mr-2"></i>Weekly Frequency
                    </h3>
                    <div class="text-4xl font-bold text-orange-600 mb-2">3-4 days</div>
                    <p class="text-gray-600">Mon/Wed/Fri or Mon/Tue/Thu/Sat</p>
                    <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                        <p class="text-sm text-blue-900"><i class="fas fa-info-circle mr-2"></i>Rest days allow full recovery between sessions</p>
                    </div>
                </div>
            </div>

            <!-- Pros and Cons -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-green-700 mb-3 flex items-center">
                        <i class="fas fa-thumbs-up mr-2"></i>Pros
                    </h3>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Perfect for beginners learning proper form</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Flexible schedule - only 3-4 days per week</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>High frequency for each muscle group</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Great for fat loss and conditioning</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-red-700 mb-3 flex items-center">
                        <i class="fas fa-thumbs-down mr-2"></i>Cons
                    </h3>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>Longer workout sessions (60-90 minutes)</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>Limited volume per muscle group per session</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>Can be fatiguing for advanced lifters</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Upper/Lower Split -->
        <div class="neuro-card p-8 mb-8 animate-fade-in">
            <div class="flex items-start justify-between mb-6">
                <div class="flex items-center">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center mr-4 shadow-lg">
                        <i class="fas fa-arrows-alt-v text-3xl text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Upper/Lower Split</h2>
                        <p class="text-sm text-gray-600 mt-1">Divide training into upper and lower body days</p>
                    </div>
                </div>
                <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">Intermediate</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Muscle Groups -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-users text-blue-600 mr-2"></i>Muscle Groups Trained
                    </h3>
                    <div class="mb-4">
                        <h4 class="font-semibold text-gray-800 mb-2">Upper Body Days:</h4>
                        <div class="space-y-1 ml-4">
                            <div class="flex items-center text-gray-700 text-sm">
                                <i class="fas fa-check text-blue-500 mr-2"></i>Chest, Back, Shoulders
                            </div>
                            <div class="flex items-center text-gray-700 text-sm">
                                <i class="fas fa-check text-blue-500 mr-2"></i>Biceps, Triceps, Forearms
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-2">Lower Body Days:</h4>
                        <div class="space-y-1 ml-4">
                            <div class="flex items-center text-gray-700 text-sm">
                                <i class="fas fa-check text-blue-500 mr-2"></i>Quads, Hamstrings, Glutes
                            </div>
                            <div class="flex items-center text-gray-700 text-sm">
                                <i class="fas fa-check text-blue-500 mr-2"></i>Calves, Core, Abs
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Weekly Frequency -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>Weekly Frequency
                    </h3>
                    <div class="text-4xl font-bold text-blue-600 mb-2">4 days</div>
                    <p class="text-gray-600 mb-4">Upper/Lower/Rest/Upper/Lower/Rest/Rest</p>
                    <div class="space-y-2">
                        <div class="p-2 bg-blue-50 rounded text-sm text-gray-800">
                            <span class="font-semibold">Mon:</span> Upper Body
                        </div>
                        <div class="p-2 bg-blue-50 rounded text-sm text-gray-800">
                            <span class="font-semibold">Tue:</span> Lower Body
                        </div>
                        <div class="p-2 bg-blue-50 rounded text-sm text-gray-800">
                            <span class="font-semibold">Thu:</span> Upper Body
                        </div>
                        <div class="p-2 bg-blue-50 rounded text-sm text-gray-800">
                            <span class="font-semibold">Fri:</span> Lower Body
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pros and Cons -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-green-700 mb-3 flex items-center">
                        <i class="fas fa-thumbs-up mr-2"></i>Pros
                    </h3>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Higher volume per muscle group</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Train each muscle group twice per week</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Good balance of frequency and recovery</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Flexible scheduling options</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-red-700 mb-3 flex items-center">
                        <i class="fas fa-thumbs-down mr-2"></i>Cons
                    </h3>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>Lower body days can be very demanding</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>Requires 4 days per week commitment</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>May need extra core/ab work</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <!-- Push/Pull/Legs Split -->
        <div class="neuro-card p-8 mb-8 animate-fade-in">
            <div class="flex items-start justify-between mb-6">
                <div class="flex items-center">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center mr-4 shadow-lg">
                        <i class="fas fa-exchange-alt text-3xl text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Push/Pull/Legs (PPL)</h2>
                        <p class="text-sm text-gray-600 mt-1">Divide training by movement patterns</p>
                    </div>
                </div>
                <span class="px-4 py-2 bg-purple-100 text-purple-800 rounded-full text-sm font-semibold">Advanced</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Muscle Groups -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-users text-purple-600 mr-2"></i>Muscle Groups Trained
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Push Days:</h4>
                            <div class="ml-4 text-sm text-gray-700">
                                <i class="fas fa-arrow-right text-purple-500 mr-2"></i>Chest, Shoulders, Triceps
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Pull Days:</h4>
                            <div class="ml-4 text-sm text-gray-700">
                                <i class="fas fa-arrow-left text-purple-500 mr-2"></i>Back, Biceps, Rear Delts
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Leg Days:</h4>
                            <div class="ml-4 text-sm text-gray-700">
                                <i class="fas fa-running text-purple-500 mr-2"></i>Quads, Hamstrings, Glutes, Calves
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Weekly Frequency -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-calendar-alt text-purple-600 mr-2"></i>Weekly Frequency
                    </h3>
                    <div class="text-4xl font-bold text-purple-600 mb-2">6 days</div>
                    <p class="text-gray-600 mb-4">Push/Pull/Legs/Push/Pull/Legs/Rest</p>
                    <div class="space-y-1">
                        <div class="flex items-center text-sm text-gray-800">
                            <span class="w-12 font-semibold">Mon:</span>
                            <span class="px-2 py-1 bg-red-100 text-red-900 rounded text-xs font-semibold">Push</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-800">
                            <span class="w-12 font-semibold">Tue:</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-900 rounded text-xs font-semibold">Pull</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-800">
                            <span class="w-12 font-semibold">Wed:</span>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-900 rounded text-xs font-semibold">Legs</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-800">
                            <span class="w-12 font-semibold">Thu:</span>
                            <span class="px-2 py-1 bg-red-100 text-red-900 rounded text-xs font-semibold">Push</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-800">
                            <span class="w-12 font-semibold">Fri:</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-900 rounded text-xs font-semibold">Pull</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-800">
                            <span class="w-12 font-semibold">Sat:</span>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-900 rounded text-xs font-semibold">Legs</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pros and Cons -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-green-700 mb-3 flex items-center">
                        <i class="fas fa-thumbs-up mr-2"></i>Pros
                    </h3>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Train each muscle group twice per week</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Optimal volume distribution</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Shorter, focused workout sessions</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Excellent for muscle growth</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Logical muscle group pairing</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-red-700 mb-3 flex items-center">
                        <i class="fas fa-thumbs-down mr-2"></i>Cons
                    </h3>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>Requires 6 days per week commitment</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>Can be demanding for recovery</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>Not ideal for beginners</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>Limited flexibility in scheduling</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bro Split -->
        <div class="neuro-card p-8 mb-8 animate-fade-in">
            <div class="flex items-start justify-between mb-6">
                <div class="flex items-center">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-red-500 to-orange-600 flex items-center justify-center mr-4 shadow-lg">
                        <i class="fas fa-fire text-3xl text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Bro Split</h2>
                        <p class="text-sm text-gray-600 mt-1">Traditional bodybuilding split - one muscle group per day</p>
                    </div>
                </div>
                <span class="px-4 py-2 bg-orange-100 text-orange-800 rounded-full text-sm font-semibold">Intermediate</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Muscle Groups -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-users text-red-600 mr-2"></i>Muscle Groups Trained
                    </h3>
                    <div class="space-y-2">
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-circle text-red-500 mr-2 text-xs"></i>
                            <span><strong>Day 1:</strong> Chest</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-circle text-blue-500 mr-2 text-xs"></i>
                            <span><strong>Day 2:</strong> Back</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-circle text-yellow-500 mr-2 text-xs"></i>
                            <span><strong>Day 3:</strong> Shoulders</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-circle text-purple-500 mr-2 text-xs"></i>
                            <span><strong>Day 4:</strong> Arms (Biceps & Triceps)</span>
                        </div>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-circle text-green-500 mr-2 text-xs"></i>
                            <span><strong>Day 5:</strong> Legs</span>
                        </div>
                    </div>
                </div>

                <!-- Weekly Frequency -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-calendar-alt text-red-600 mr-2"></i>Weekly Frequency
                    </h3>
                    <div class="text-4xl font-bold text-red-600 mb-2">5 days</div>
                    <p class="text-gray-600 mb-4">Each muscle group once per week</p>
                    <div class="p-4 bg-yellow-50 rounded-lg border-l-4 border-yellow-500">
                        <p class="text-sm text-yellow-800">
                            <i class="fas fa-lightbulb mr-2"></i>
                            <strong>Classic Bodybuilding:</strong> Focus on maximum volume per muscle group in single session
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pros and Cons -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-green-700 mb-3 flex items-center">
                        <i class="fas fa-thumbs-up mr-2"></i>Pros
                    </h3>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Maximum focus on single muscle group</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Full week recovery for each muscle</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Great for targeting weak points</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Mentally satisfying "pump" workouts</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Easy to plan and follow</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-red-700 mb-3 flex items-center">
                        <i class="fas fa-thumbs-down mr-2"></i>Cons
                    </h3>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>Low frequency (once per week per muscle)</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>Not optimal for natural lifters</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>Missing one day affects that muscle for the week</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>Can lead to overtraining single muscles</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Advanced 5-6 Day Specialized Splits -->
        <div class="neuro-card p-8 mb-8 animate-fade-in">
            <div class="flex items-start justify-between mb-6">
                <div class="flex items-center">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center mr-4 shadow-lg">
                        <i class="fas fa-trophy text-3xl text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Advanced Specialized Splits</h2>
                        <p class="text-sm text-gray-600 mt-1">High-frequency programs for experienced lifters</p>
                    </div>
                </div>
                <span class="px-4 py-2 bg-indigo-100 text-indigo-800 rounded-full text-sm font-semibold">Expert Level</span>
            </div>

            <!-- Split Options -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Arnold Split -->
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-lg p-6 border-2 border-indigo-200">
                    <h3 class="text-xl font-bold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-star text-indigo-600 mr-2"></i>Arnold Split (6 Days)
                    </h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center">
                            <span class="w-20 font-semibold">Day 1:</span>
                            <span class="text-gray-700">Chest & Back</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-20 font-semibold">Day 2:</span>
                            <span class="text-gray-700">Shoulders & Arms</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-20 font-semibold">Day 3:</span>
                            <span class="text-gray-700">Legs & Abs</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-20 font-semibold">Day 4-6:</span>
                            <span class="text-gray-700">Repeat</span>
                        </div>
                    </div>
                    <div class="mt-4 p-3 bg-white rounded">
                        <p class="text-xs text-gray-600"><strong>Best for:</strong> Bodybuilders seeking maximum muscle growth with high volume</p>
                    </div>
                </div>

                <!-- Power Building Split -->
                <div class="bg-gradient-to-br from-red-50 to-orange-50 rounded-lg p-6 border-2 border-red-200">
                    <h3 class="text-xl font-bold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-bolt text-red-600 mr-2"></i>Power Building (5 Days)
                    </h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center">
                            <span class="w-20 font-semibold">Day 1:</span>
                            <span class="text-gray-700">Heavy Squat Focus</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-20 font-semibold">Day 2:</span>
                            <span class="text-gray-700">Heavy Bench Focus</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-20 font-semibold">Day 3:</span>
                            <span class="text-gray-700">Accessory Upper</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-20 font-semibold">Day 4:</span>
                            <span class="text-gray-700">Heavy Deadlift Focus</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-20 font-semibold">Day 5:</span>
                            <span class="text-gray-700">Accessory Lower</span>
                        </div>
                    </div>
                    <div class="mt-4 p-3 bg-white rounded">
                        <p class="text-xs text-gray-600"><strong>Best for:</strong> Combining strength and hypertrophy goals</p>
                    </div>
                </div>
            </div>

            <!-- Key Characteristics -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-key text-indigo-600 mr-2"></i>Key Characteristics
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex items-start">
                        <i class="fas fa-check-double text-indigo-600 mr-2 mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">High Frequency</p>
                            <p class="text-sm text-gray-600">Train muscles 2-3x per week</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-chart-line text-indigo-600 mr-2 mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Progressive Overload</p>
                            <p class="text-sm text-gray-600">Systematic strength progression</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-balance-scale text-indigo-600 mr-2 mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Volume Management</p>
                            <p class="text-sm text-gray-600">Carefully balanced weekly volume</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pros and Cons -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-green-700 mb-3 flex items-center">
                        <i class="fas fa-thumbs-up mr-2"></i>Pros
                    </h3>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Maximum muscle growth potential</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Optimal training frequency</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Can combine strength and size goals</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-plus-circle text-green-500 mr-2 mt-1"></i>
                            <span>Highly customizable to individual needs</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-red-700 mb-3 flex items-center">
                        <i class="fas fa-thumbs-down mr-2"></i>Cons
                    </h3>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>Requires advanced training experience</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>High recovery demands</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>Needs excellent nutrition and sleep</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <i class="fas fa-minus-circle text-red-500 mr-2 mt-1"></i>
                            <span>Risk of overtraining if not managed properly</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="neuro-card p-8 bg-gradient-to-br from-orange-50 to-red-50 border-2 border-orange-200">
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-lightbulb text-orange-600 mr-3"></i>Choosing the Right Split
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg p-4 shadow-sm">
                    <h3 class="font-bold text-green-700 mb-2">Beginners</h3>
                    <p class="text-sm text-gray-700 mb-2">Start with <strong>Full-Body</strong> or <strong>Upper/Lower</strong></p>
                    <p class="text-xs text-gray-600">Focus on learning proper form and building a foundation</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm">
                    <h3 class="font-bold text-blue-700 mb-2">Intermediates</h3>
                    <p class="text-sm text-gray-700 mb-2">Progress to <strong>Upper/Lower</strong> or <strong>PPL</strong></p>
                    <p class="text-xs text-gray-600">Increase volume and frequency for continued growth</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm">
                    <h3 class="font-bold text-purple-700 mb-2">Advanced</h3>
                    <p class="text-sm text-gray-700 mb-2">Try <strong>PPL</strong> or <strong>Specialized Splits</strong></p>
                    <p class="text-xs text-gray-600">Optimize training based on specific goals and recovery</p>
                </div>
            </div>
            <div class="mt-6 p-4 bg-white rounded-lg">
                <p class="text-sm text-gray-700">
                    <i class="fas fa-info-circle text-orange-600 mr-2"></i>
                    <strong>Remember:</strong> The best split is the one you can consistently follow while making progress. 
                    Consider your schedule, recovery ability, and training goals when choosing a program.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
