@extends('layouts.app')

@section('title', 'Welcome to TitansGym')

@section('content')
<!-- Hero Section with Gym Background -->
<div class="relative overflow-hidden min-h-screen flex items-center">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0">
        <img src="{{ asset('assets/486827638_1149805063609549_8940020966003057342_n.jpg') }}" 
             alt="Titans Gym" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/70 to-orange-900/60"></div>
    </div>

    <!-- Animated Accent Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-96 h-96 bg-orange-500 rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-pulse-slow"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-red-600 rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-pulse-slow" style="animation-delay: 1s;"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 z-10">
        <div class="text-center lg:text-left max-w-4xl">
            <h1 class="text-6xl md:text-8xl font-display font-black text-white mb-6 animate-fade-in leading-tight">
                UNLEASH YOUR
                <span class="block bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 bg-clip-text text-transparent">
                    INNER TITAN
                </span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 mb-10 max-w-2xl animate-fade-in leading-relaxed" style="animation-delay: 0.1s;">
                Transform your fitness journey with cutting-edge training, expert guidance, and a community that pushes you beyond your limits.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center lg:justify-start items-center animate-fade-in" style="animation-delay: 0.2s;">
                @guest
                    <a href="{{ route('register') }}" class="group inline-flex items-center px-10 py-5 bg-gradient-to-r from-orange-600 to-red-600 text-white font-bold text-lg rounded-xl hover:shadow-2xl hover:shadow-orange-500/50 transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-fire mr-3 group-hover:animate-bounce"></i>
                        START YOUR JOURNEY
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-10 py-5 bg-white/10 backdrop-blur-md border-2 border-white/30 text-white font-bold text-lg rounded-xl hover:bg-white/20 transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-sign-in-alt mr-3"></i>
                        MEMBER LOGIN
                    </a>
                @else
                    @php
                        $dashboardRoute = match(Auth::user()->role) {
                            'admin' => 'admin.dashboard',
                            'trainer' => 'trainer.dashboard',
                            'member' => 'member.dashboard',
                            default => 'home'
                        };
                    @endphp
                    <a href="{{ route($dashboardRoute) }}" class="inline-flex items-center px-10 py-5 bg-gradient-to-r from-orange-600 to-red-600 text-white font-bold text-lg rounded-xl hover:shadow-2xl hover:shadow-orange-500/50 transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        GO TO DASHBOARD
                    </a>
                @endguest
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
        <i class="fas fa-chevron-down text-white text-3xl opacity-50"></i>
    </div>
</div>

<!-- Gym Showcase Section -->
<div class="bg-gradient-to-b from-gray-900 to-black py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-display font-black text-white mb-4">
                WORLD-CLASS <span class="text-orange-500">FACILITIES</span>
            </h2>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                State-of-the-art equipment and premium amenities designed for champions
            </p>
        </div>

        <!-- Image Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
            <div class="group relative overflow-hidden rounded-2xl aspect-square">
                <img src="{{ asset('assets/486466830_1149805360276186_2449750571136577295_n.jpg') }}" 
                     alt="Training Area" 
                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                    <p class="text-white font-bold text-xl p-6">Premium Equipment</p>
                </div>
            </div>
            <div class="group relative overflow-hidden rounded-2xl aspect-square">
                <img src="{{ asset('assets/486621968_1149805393609516_3419081806466295778_n.jpg') }}" 
                     alt="Cardio Zone" 
                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                    <p class="text-white font-bold text-xl p-6">Cardio Zone</p>
                </div>
            </div>
            <div class="group relative overflow-hidden rounded-2xl aspect-square">
                <img src="{{ asset('assets/488505264_1159398815983507_5492341875940900313_n.jpg') }}" 
                     alt="Training Sessions" 
                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                    <p class="text-white font-bold text-xl p-6">Expert Training</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="bg-black py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-display font-black text-white mb-4">
                COMPLETE <span class="text-orange-500">MANAGEMENT</span> SYSTEM
            </h2>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                Everything you need to run a successful fitness empire
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 border border-orange-500/20 rounded-2xl p-8 hover:border-orange-500/50 hover:shadow-2xl hover:shadow-orange-500/20 transform hover:-translate-y-2 transition-all duration-300 group">
                <div class="bg-gradient-to-br from-orange-600 to-red-600 rounded-xl p-4 w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-orange-500/50">
                    <i class="fas fa-users text-2xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">Member Management</h3>
                <p class="text-gray-400">
                    Track memberships, monitor attendance, and manage member profiles with our powerful dashboard.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 border border-orange-500/20 rounded-2xl p-8 hover:border-orange-500/50 hover:shadow-2xl hover:shadow-orange-500/20 transform hover:-translate-y-2 transition-all duration-300 group">
                <div class="bg-gradient-to-br from-orange-600 to-red-600 rounded-xl p-4 w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-orange-500/50">
                    <i class="fas fa-dumbbell text-2xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">Trainer Coordination</h3>
                <p class="text-gray-400">
                    Empower trainers to create custom workout plans and track client progress in real-time.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 border border-orange-500/20 rounded-2xl p-8 hover:border-orange-500/50 hover:shadow-2xl hover:shadow-orange-500/20 transform hover:-translate-y-2 transition-all duration-300 group">
                <div class="bg-gradient-to-br from-orange-600 to-red-600 rounded-xl p-4 w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-orange-500/50">
                    <i class="fas fa-calendar-check text-2xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">Smart Booking</h3>
                <p class="text-gray-400">
                    Intelligent scheduling system that prevents conflicts and maximizes trainer efficiency.
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 border border-orange-500/20 rounded-2xl p-8 hover:border-orange-500/50 hover:shadow-2xl hover:shadow-orange-500/20 transform hover:-translate-y-2 transition-all duration-300 group">
                <div class="bg-gradient-to-br from-orange-600 to-red-600 rounded-xl p-4 w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-orange-500/50">
                    <i class="fas fa-dollar-sign text-2xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">Payment Processing</h3>
                <p class="text-gray-400">
                    Streamlined payment tracking, invoicing, and subscription management with detailed reports.
                </p>
            </div>

            <!-- Feature 5 -->
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 border border-orange-500/20 rounded-2xl p-8 hover:border-orange-500/50 hover:shadow-2xl hover:shadow-orange-500/20 transform hover:-translate-y-2 transition-all duration-300 group">
                <div class="bg-gradient-to-br from-orange-600 to-red-600 rounded-xl p-4 w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-orange-500/50">
                    <i class="fas fa-chart-line text-2xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">Progress Tracking</h3>
                <p class="text-gray-400">
                    Monitor member progress with detailed metrics, measurements, and achievement milestones.
                </p>
            </div>

            <!-- Feature 6 -->
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 border border-orange-500/20 rounded-2xl p-8 hover:border-orange-500/50 hover:shadow-2xl hover:shadow-orange-500/20 transform hover:-translate-y-2 transition-all duration-300 group">
                <div class="bg-gradient-to-br from-orange-600 to-red-600 rounded-xl p-4 w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-orange-500/50">
                    <i class="fas fa-chart-bar text-2xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">Analytics & Reports</h3>
                <p class="text-gray-400">
                    Make data-driven decisions with comprehensive insights on revenue and engagement.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="relative py-20 overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('assets/475067452_4233417863554070_1488481775833933170_n.jpg') }}" 
             alt="Gym Stats" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-orange-900/95 to-red-900/95"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center text-white">
            <div class="animate-fade-in">
                <div class="text-6xl font-black mb-3 bg-gradient-to-r from-orange-300 to-yellow-300 bg-clip-text text-transparent">10K+</div>
                <div class="text-2xl font-bold uppercase tracking-wider">Active Members</div>
            </div>
            <div class="animate-fade-in" style="animation-delay: 0.1s;">
                <div class="text-6xl font-black mb-3 bg-gradient-to-r from-orange-300 to-yellow-300 bg-clip-text text-transparent">500+</div>
                <div class="text-2xl font-bold uppercase tracking-wider">Certified Trainers</div>
            </div>
            <div class="animate-fade-in" style="animation-delay: 0.2s;">
                <div class="text-6xl font-black mb-3 bg-gradient-to-r from-orange-300 to-yellow-300 bg-clip-text text-transparent">99.9%</div>
                <div class="text-2xl font-bold uppercase tracking-wider">Satisfaction Rate</div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-gradient-to-b from-black to-gray-900 py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-r from-orange-600/20 to-red-600/20 blur-3xl"></div>
            <div class="relative bg-gradient-to-br from-gray-900 to-gray-800 border-2 border-orange-500/30 rounded-3xl p-12 hover:border-orange-500/60 transition-all duration-300">
                <h2 class="text-5xl font-display font-black text-white mb-6">
                    READY TO BECOME A <span class="text-orange-500">TITAN?</span>
                </h2>
                <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
                    Join the elite community of champions who refuse to settle for average. Your transformation starts now.
                </p>
                @guest
                    <a href="{{ route('register') }}" class="inline-flex items-center px-12 py-6 bg-gradient-to-r from-orange-600 to-red-600 text-white font-black text-xl rounded-xl hover:shadow-2xl hover:shadow-orange-500/50 transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-fire mr-3"></i>
                        START YOUR TRANSFORMATION
                    </a>
                @else
                    @php
                        $dashboardRoute = match(Auth::user()->role) {
                            'admin' => 'admin.dashboard',
                            'trainer' => 'trainer.dashboard',
                            'member' => 'member.dashboard',
                            default => 'home'
                        };
                    @endphp
                    <a href="{{ route($dashboardRoute) }}" class="inline-flex items-center px-12 py-6 bg-gradient-to-r from-orange-600 to-red-600 text-white font-black text-xl rounded-xl hover:shadow-2xl hover:shadow-orange-500/50 transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        GO TO DASHBOARD
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes pulse-slow {
        0%, 100% {
            opacity: 0.2;
            transform: scale(1);
        }
        50% {
            opacity: 0.3;
            transform: scale(1.1);
        }
    }
    
    .animate-pulse-slow {
        animation: pulse-slow 4s ease-in-out infinite;
    }
</style>
@endsection
