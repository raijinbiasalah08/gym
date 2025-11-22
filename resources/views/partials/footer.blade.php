<footer class="glass-card mt-16 border-t border-gray-200 border-opacity-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand Section -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center mb-4">
                    <div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg p-2 mr-3">
                        <i class="fas fa-dumbbell text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-display font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        TitansGym
                    </h3>
                </div>
                <p class="text-gray-600 mb-4 max-w-md">
                    The modern, all-in-one platform for managing your gym, trainers, members, and everything in between.
                </p>
                <div class="flex space-x-3">
                    <a href="#" class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-3 rounded-lg hover:scale-110 transition-transform shadow-md">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="bg-gradient-to-br from-blue-400 to-blue-500 text-white p-3 rounded-lg hover:scale-110 transition-transform shadow-md">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="bg-gradient-to-br from-pink-500 to-pink-600 text-white p-3 rounded-lg hover:scale-110 transition-transform shadow-md">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="bg-gradient-to-br from-blue-600 to-blue-700 text-white p-3 rounded-lg hover:scale-110 transition-transform shadow-md">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-bold text-gray-900 mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            Home
                        </a>
                    </li>
                    @auth
                        <li>
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 transition-colors flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                Dashboard
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 transition-colors flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                Login
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600 transition-colors flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                Register
                            </a>
                        </li>
                    @endauth
                    <li>
                        <a href="{{ route('about') }}" class="text-gray-600 hover:text-blue-600 transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-gray-600 hover:text-blue-600 transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            Contact
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-bold text-gray-900 mb-4">Contact Us</h4>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-2 mr-3 flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-white text-sm"></i>
                        </div>
                        <span class="text-gray-600 text-sm">
                            123 Fitness Street<br>
                            Gym City, GC 12345
                        </span>
                    </li>
                    <li class="flex items-center">
                        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-2 mr-3">
                            <i class="fas fa-phone text-white text-sm"></i>
                        </div>
                        <a href="tel:+1234567890" class="text-gray-600 hover:text-blue-600 transition-colors text-sm">
                            +1 (234) 567-890
                        </a>
                    </li>
                    <li class="flex items-center">
                        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-2 mr-3">
                            <i class="fas fa-envelope text-white text-sm"></i>
                        </div>
                        <a href="mailto:info@titansgym.com" class="text-gray-600 hover:text-blue-600 transition-colors text-sm">
                            info@titansgym.com
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="mt-8 pt-8 border-t border-gray-200 border-opacity-50">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-600 text-sm mb-4 md:mb-0">
                    &copy; {{ date('Y') }} TitansGym. All rights reserved.
                </p>
                <div class="flex space-x-6 text-sm">
                    <a href="{{ route('privacy') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Terms of Service</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>