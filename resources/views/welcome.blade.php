@extends('layouts.app')

@section('title', 'Welcome to TitansGym')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
        <div class="absolute top-40 right-10 w-72 h-72 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-20 left-1/2 w-72 h-72 bg-pink-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
            <h1 class="text-5xl md:text-7xl font-display font-bold text-gray-900 mb-6 animate-fade-in">
                Welcome to <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">TitansGym</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-600 mb-8 max-w-3xl mx-auto animate-fade-in" style="animation-delay: 0.1s;">
                The modern, all-in-one platform for managing your gym, trainers, members, and everything in between.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in" style="animation-delay: 0.2s;">
                @guest
                    <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 glass-card text-gray-900 font-semibold rounded-xl hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <i class="fas fa-user-plus mr-2"></i>
                        Get Started
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                        <i class="fas fa-tachometer-alt mr-2"></i>
                        Go to Dashboard
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-16">
        <h2 class="text-4xl font-display font-bold text-gray-900 mb-4">
            Everything You Need to Run Your Gym
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            Powerful features designed to streamline operations and enhance member experience
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Feature 1 -->
        <div class="glass-card rounded-2xl p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 group">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-4 w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                <i class="fas fa-users text-2xl text-white"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Member Management</h3>
            <p class="text-gray-600">
                Effortlessly manage member profiles, track memberships, and monitor attendance with our intuitive dashboard.
            </p>
        </div>

        <!-- Feature 2 -->
        <div class="glass-card rounded-2xl p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 group">
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-4 w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                <i class="fas fa-dumbbell text-2xl text-white"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Trainer Coordination</h3>
            <p class="text-gray-600">
                Empower trainers with tools to create workout plans, track client progress, and manage their schedules.
            </p>
        </div>

        <!-- Feature 3 -->
        <div class="glass-card rounded-2xl p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 group">
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-4 w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                <i class="fas fa-calendar-check text-2xl text-white"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Smart Booking</h3>
            <p class="text-gray-600">
                Streamline session bookings with our intelligent scheduling system that prevents conflicts and maximizes efficiency.
            </p>
        </div>

        <!-- Feature 4 -->
        <div class="glass-card rounded-2xl p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 group">
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl p-4 w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                <i class="fas fa-dollar-sign text-2xl text-white"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Payment Processing</h3>
            <p class="text-gray-600">
                Track payments, generate invoices, and manage subscriptions all in one place with detailed financial reports.
            </p>
        </div>

        <!-- Feature 5 -->
        <div class="glass-card rounded-2xl p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 group">
            <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl p-4 w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                <i class="fas fa-chart-line text-2xl text-white"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Progress Tracking</h3>
            <p class="text-gray-600">
                Monitor member progress with detailed metrics, body measurements, and achievement milestones.
            </p>
        </div>

        <!-- Feature 6 -->
        <div class="glass-card rounded-2xl p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 group">
            <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl p-4 w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                <i class="fas fa-chart-bar text-2xl text-white"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Analytics & Reports</h3>
            <p class="text-gray-600">
                Make data-driven decisions with comprehensive reports on revenue, attendance, and member engagement.
            </p>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="bg-gradient-to-r from-blue-600 to-purple-600 py-16 my-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center text-white">
            <div class="animate-fade-in">
                <div class="text-5xl font-bold mb-2">10K+</div>
                <div class="text-xl opacity-90">Active Members</div>
            </div>
            <div class="animate-fade-in" style="animation-delay: 0.1s;">
                <div class="text-5xl font-bold mb-2">500+</div>
                <div class="text-xl opacity-90">Certified Trainers</div>
            </div>
            <div class="animate-fade-in" style="animation-delay: 0.2s;">
                <div class="text-5xl font-bold mb-2">99.9%</div>
                <div class="text-xl opacity-90">Uptime Guarantee</div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
    <div class="glass-card rounded-3xl p-12">
        <h2 class="text-4xl font-display font-bold text-gray-900 mb-4">
            Ready to Transform Your Gym?
        </h2>
        <p class="text-lg text-gray-600 mb-8">
            Join thousands of gyms already using TitansGym to streamline their operations and delight their members.
        </p>
        @guest
            <a href="{{ route('register') }}" class="inline-flex items-center px-10 py-5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold text-lg rounded-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                <i class="fas fa-rocket mr-3"></i>
                Start Free Trial
            </a>
        @else
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-10 py-5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold text-lg rounded-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Go to Dashboard
            </a>
        @endguest
    </div>
</div>

<style>
    @keyframes blob {
        0%, 100% {
            transform: translate(0, 0) scale(1);
        }
        33% {
            transform: translate(30px, -50px) scale(1.1);
        }
        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
    }
    
    .animate-blob {
        animation: blob 7s infinite;
    }
    
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
@endsection
