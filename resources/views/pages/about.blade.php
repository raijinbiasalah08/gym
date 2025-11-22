@extends('layouts.app')

@section('title', 'About Us - TitansGym')

@section('content')
<div class="relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
        <div class="absolute bottom-20 right-10 w-72 h-72 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-display font-bold text-gray-900 mb-6">
                About <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">TitansGym</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                We are dedicated to transforming the fitness industry through innovative technology and seamless user experiences.
            </p>
        </div>

        <!-- Mission & Vision -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-20">
            <div class="glass-card p-8 rounded-2xl transform hover:-translate-y-1 transition-all duration-300">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mb-6">
                    <i class="fas fa-bullseye text-2xl text-blue-600"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Our Mission</h2>
                <p class="text-gray-600 leading-relaxed">
                    To empower gym owners, trainers, and members with a comprehensive management platform that simplifies operations, enhances engagement, and drives fitness success.
                </p>
            </div>

            <div class="glass-card p-8 rounded-2xl transform hover:-translate-y-1 transition-all duration-300">
                <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mb-6">
                    <i class="fas fa-eye text-2xl text-purple-600"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Our Vision</h2>
                <p class="text-gray-600 leading-relaxed">
                    To be the global standard for gym management software, fostering a healthier world by making fitness accessible, organized, and enjoyable for everyone.
                </p>
            </div>
        </div>

        <!-- Stats -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-12 text-white mb-20 shadow-xl">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold mb-2">5+</div>
                    <div class="text-blue-100">Years Experience</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">500+</div>
                    <div class="text-blue-100">Partner Gyms</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">10k+</div>
                    <div class="text-blue-100">Active Members</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">24/7</div>
                    <div class="text-blue-100">Support</div>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Meet Our Team</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                The passionate individuals behind TitansGym working hard to bring you the best experience.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Team Member 1 -->
            <div class="glass-card rounded-xl overflow-hidden group">
                <div class="h-48 bg-gray-200 relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 opacity-80"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-user text-6xl text-white opacity-50"></i>
                    </div>
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-gray-900">Alex Johnson</h3>
                    <p class="text-blue-600 font-medium mb-4">CEO & Founder</p>
                    <p class="text-gray-600 text-sm mb-4">
                        Visionary leader with over 15 years in the fitness and tech industries.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>

            <!-- Team Member 2 -->
            <div class="glass-card rounded-xl overflow-hidden group">
                <div class="h-48 bg-gray-200 relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-purple-600 opacity-80"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-user text-6xl text-white opacity-50"></i>
                    </div>
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-gray-900">Sarah Williams</h3>
                    <p class="text-purple-600 font-medium mb-4">Head of Product</p>
                    <p class="text-gray-600 text-sm mb-4">
                        Product strategist focused on creating intuitive and powerful user experiences.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>

            <!-- Team Member 3 -->
            <div class="glass-card rounded-xl overflow-hidden group">
                <div class="h-48 bg-gray-200 relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-pink-500 to-pink-600 opacity-80"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-user text-6xl text-white opacity-50"></i>
                    </div>
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-gray-900">Michael Chen</h3>
                    <p class="text-pink-600 font-medium mb-4">Lead Developer</p>
                    <p class="text-gray-600 text-sm mb-4">
                        Full-stack expert ensuring our platform is robust, secure, and scalable.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
