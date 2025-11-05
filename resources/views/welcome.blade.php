@extends('layouts.app')

@section('title', 'Welcome - GymSystem')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-gray-100">
    <!-- Hero Section -->
    <div class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Welcome to</span>
                            <span class="block text-blue-600 xl:inline">GymSystem</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Professional gym management system designed to streamline your fitness center operations. 
                            Manage members, trainers, bookings, and payments all in one place.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            @auth
                                <div class="rounded-md shadow">
                                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : (auth()->user()->isTrainer() ? route('trainer.dashboard') : route('member.dashboard')) }}" 
                                       class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10">
                                        Go to Dashboard
                                    </a>
                                </div>
                            @else
                                <div class="rounded-md shadow">
                                    <a href="{{ route('register') }}" 
                                       class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10">
                                        Get Started
                                    </a>
                                </div>
                                <div class="mt-3 sm:mt-0 sm:ml-3">
                                    <a href="{{ route('login') }}" 
                                       class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 md:py-4 md:text-lg md:px-10">
                                        Sign In
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <div class="h-56 w-full bg-gradient-to-r from-blue-400 to-blue-600 sm:h-72 md:h-96 lg:w-full lg:h-full flex items-center justify-center">
                <i class="fas fa-dumbbell text-white text-8xl opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Features</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Everything you need to manage your gym
                </p>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Feature 1 -->
                    <div class="text-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white mx-auto">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                        <h3 class="mt-5 text-lg leading-6 font-medium text-gray-900">Member Management</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Easily manage member profiles, memberships, and attendance records.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="text-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white mx-auto">
                            <i class="fas fa-dumbbell text-xl"></i>
                        </div>
                        <h3 class="mt-5 text-lg leading-6 font-medium text-gray-900">Trainer Management</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Manage trainer schedules, specializations, and client assignments.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="text-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-purple-500 text-white mx-auto">
                            <i class="fas fa-calendar-alt text-xl"></i>
                        </div>
                        <h3 class="mt-5 text-lg leading-6 font-medium text-gray-900">Booking System</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Streamlined session booking with real-time availability checking.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="text-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-yellow-500 text-white mx-auto">
                            <i class="fas fa-chart-line text-xl"></i>
                        </div>
                        <h3 class="mt-5 text-lg leading-6 font-medium text-gray-900">Progress Tracking</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Monitor member progress with detailed metrics and analytics.
                        </p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="text-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-red-500 text-white mx-auto">
                            <i class="fas fa-money-bill-wave text-xl"></i>
                        </div>
                        <h3 class="mt-5 text-lg leading-6 font-medium text-gray-900">Payment Processing</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Handle payments, invoices, and membership renewals efficiently.
                        </p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="text-center">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mx-auto">
                            <i class="fas fa-clipboard-list text-xl"></i>
                        </div>
                        <h3 class="mt-5 text-lg leading-6 font-medium text-gray-900">Workout Plans</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Create and manage personalized workout plans for members.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection