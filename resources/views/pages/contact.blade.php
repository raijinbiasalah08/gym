@extends('layouts.app')

@section('title', 'Contact Us - TitansGym')

@section('content')
<div class="relative overflow-hidden py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-display font-bold text-gray-900 mb-6">
                Get in <span class="bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">Touch</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="glass-card p-8 rounded-2xl">
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-2">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all" placeholder="John">
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-2">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all" placeholder="Doe">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all" placeholder="you@example.com">
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">Subject</label>
                        <select id="subject" name="subject" class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">
                            <option value="">Select a topic</option>
                            <option value="support">Technical Support</option>
                            <option value="sales">Sales Inquiry</option>
                            <option value="feedback">Feedback</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                        <textarea id="message" name="message" rows="4" class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all" placeholder="How can we help you?"></textarea>
                    </div>

                    <button type="button" onclick="alert('This is a demo form. In a real application, this would send an email.')" class="w-full bg-gradient-to-r from-orange-600 to-red-600 text-white font-bold py-3 px-6 rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="space-y-8">
                <div class="glass-card p-8 rounded-2xl hover:shadow-lg transition-shadow">
                    <div class="flex items-start">
                        <div class="bg-blue-100 rounded-full p-4 mr-6">
                            <i class="fas fa-map-marker-alt text-2xl text-orange-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Visit Us</h3>
                            <p class="text-gray-600 leading-relaxed">
                                123 Fitness Street<br>
                                Gym City, GC 12345<br>
                                United States
                            </p>
                        </div>
                    </div>
                </div>

                <div class="glass-card p-8 rounded-2xl hover:shadow-lg transition-shadow">
                    <div class="flex items-start">
                        <div class="bg-green-100 rounded-full p-4 mr-6">
                            <i class="fas fa-phone-alt text-2xl text-green-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Call Us</h3>
                            <p class="text-gray-600 mb-2">Mon-Fri from 8am to 5pm.</p>
                            <a href="tel:+1234567890" class="text-orange-600 font-semibold hover:text-orange-800 transition">+1 (234) 567-890</a>
                        </div>
                    </div>
                </div>

                <div class="glass-card p-8 rounded-2xl hover:shadow-lg transition-shadow">
                    <div class="flex items-start">
                        <div class="bg-purple-100 rounded-full p-4 mr-6">
                            <i class="fas fa-envelope text-2xl text-purple-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Email Us</h3>
                            <p class="text-gray-600 mb-2">We'll get back to you within 24 hours.</p>
                            <a href="mailto:info@titansgym.com" class="text-orange-600 font-semibold hover:text-orange-800 transition">info@titansgym.com</a>
                        </div>
                    </div>
                </div>

                <!-- Map Placeholder -->
                <div class="glass-card rounded-2xl overflow-hidden h-64 bg-gray-200 relative">
                    <div class="absolute inset-0 flex items-center justify-center bg-gray-300">
                        <p class="text-gray-500 font-medium flex items-center">
                            <i class="fas fa-map mr-2"></i> Google Maps Integration
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
