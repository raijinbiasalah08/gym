@extends('layouts.app')

@section('title', 'Design System Showcase')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-display font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent mb-4">
                Design System Showcase
            </h1>
            <p class="text-xl text-gray-600">
                All components and styles used in GymSystem
            </p>
        </div>

        <!-- Colors -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Color Palette</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <div class="glass-card rounded-xl p-4 text-center">
                    <div class="h-20 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg mb-3"></div>
                    <p class="text-sm font-semibold">Blue</p>
                </div>
                <div class="glass-card rounded-xl p-4 text-center">
                    <div class="h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-lg mb-3"></div>
                    <p class="text-sm font-semibold">Green</p>
                </div>
                <div class="glass-card rounded-xl p-4 text-center">
                    <div class="h-20 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg mb-3"></div>
                    <p class="text-sm font-semibold">Purple</p>
                </div>
                <div class="glass-card rounded-xl p-4 text-center">
                    <div class="h-20 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg mb-3"></div>
                    <p class="text-sm font-semibold">Yellow</p>
                </div>
                <div class="glass-card rounded-xl p-4 text-center">
                    <div class="h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-lg mb-3"></div>
                    <p class="text-sm font-semibold">Red</p>
                </div>
                <div class="glass-card rounded-xl p-4 text-center">
                    <div class="h-20 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg mb-3"></div>
                    <p class="text-sm font-semibold">Indigo</p>
                </div>
            </div>
        </section>

        <!-- Buttons -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Buttons</h2>
            <div class="glass-card rounded-xl p-8">
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-600 mb-2">Primary Button</p>
                        <button class="px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 text-white font-semibold rounded-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                            <i class="fas fa-check mr-2"></i>Primary Action
                        </button>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600 mb-2">Secondary Button</p>
                        <button class="px-6 py-3 glass-card text-gray-900 font-semibold rounded-lg hover:shadow-lg transition-all duration-300">
                            <i class="fas fa-times mr-2"></i>Secondary Action
                        </button>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600 mb-2">Icon Buttons</p>
                        <div class="flex space-x-3">
                            <button class="p-3 rounded-lg bg-gradient-to-br from-orange-500 to-red-600 text-white hover:scale-110 transition-transform shadow-lg">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="p-3 rounded-lg bg-gradient-to-br from-green-500 to-green-600 text-white hover:scale-110 transition-transform shadow-lg">
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="p-3 rounded-lg bg-gradient-to-br from-red-500 to-red-600 text-white hover:scale-110 transition-transform shadow-lg">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cards -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Cards</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Stat Card -->
                <div class="glass-card overflow-hidden rounded-xl transition hover:shadow-lg group">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="rounded-xl bg-gradient-to-br from-orange-500 to-red-600 p-3 shadow-lg group-hover:scale-110 transition-transform">
                                    <i class="fas fa-users text-2xl text-white"></i>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-600 truncate">Total Users</dt>
                                    <dd class="text-2xl font-bold text-gray-900 mt-1">1,234</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature Card -->
                <div class="glass-card rounded-xl p-6 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 group">
                    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-4 w-16 h-16 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform shadow-lg">
                        <i class="fas fa-dumbbell text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Feature Title</h3>
                    <p class="text-gray-600">This is a feature card with glassmorphism and hover effects.</p>
                </div>

                <!-- Info Card -->
                <div class="glass-card rounded-xl p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Information Card</h3>
                    <p class="text-gray-600 mb-4">Simple card with glassmorphism background.</p>
                    <button class="text-orange-600 font-semibold hover:text-orange-700">
                        Learn More <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>
            </div>
        </section>

        <!-- Badges -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Badges</h2>
            <div class="glass-card rounded-xl p-8">
                <div class="flex flex-wrap gap-3">
                    <span class="bg-gradient-to-r from-green-500 to-green-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                        Active
                    </span>
                    <span class="bg-gradient-to-r from-orange-500 to-red-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                        Premium
                    </span>
                    <span class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                        Pending
                    </span>
                    <span class="bg-gradient-to-r from-red-500 to-red-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                        Expired
                    </span>
                    <span class="bg-gradient-to-r from-orange-500 to-red-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                        Featured
                    </span>
                    <span class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">
                        New
                    </span>
                </div>
            </div>
        </section>

        <!-- Forms -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Form Elements</h2>
            <div class="glass-card rounded-xl p-8">
                <div class="space-y-4 max-w-md">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Text Input</label>
                        <input type="text" placeholder="Enter text..." class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Select Dropdown</label>
                        <select class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Textarea</label>
                        <textarea rows="3" placeholder="Enter message..." class="w-full px-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all"></textarea>
                    </div>
                </div>
            </div>
        </section>

        <!-- Icons -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Icon Styles</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="glass-card rounded-xl p-6 text-center">
                    <div class="bg-gradient-to-br from-orange-500 to-red-600 rounded-full p-4 w-16 h-16 flex items-center justify-center mx-auto mb-3 shadow-lg">
                        <i class="fas fa-users text-2xl text-white"></i>
                    </div>
                    <p class="text-sm font-semibold">Users</p>
                </div>
                <div class="glass-card rounded-xl p-6 text-center">
                    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-full p-4 w-16 h-16 flex items-center justify-center mx-auto mb-3 shadow-lg">
                        <i class="fas fa-dumbbell text-2xl text-white"></i>
                    </div>
                    <p class="text-sm font-semibold">Fitness</p>
                </div>
                <div class="glass-card rounded-xl p-6 text-center">
                    <div class="bg-gradient-to-br from-orange-500 to-red-600 rounded-full p-4 w-16 h-16 flex items-center justify-center mx-auto mb-3 shadow-lg">
                        <i class="fas fa-calendar text-2xl text-white"></i>
                    </div>
                    <p class="text-sm font-semibold">Schedule</p>
                </div>
                <div class="glass-card rounded-xl p-6 text-center">
                    <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full p-4 w-16 h-16 flex items-center justify-center mx-auto mb-3 shadow-lg">
                        <i class="fas fa-dollar-sign text-2xl text-white"></i>
                    </div>
                    <p class="text-sm font-semibold">Payments</p>
                </div>
            </div>
        </section>

        <!-- Toast Demo -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Toast Notifications</h2>
            <div class="glass-card rounded-xl p-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <button onclick="showToast('Success! Operation completed.', 'success')" class="px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-lg hover:shadow-lg transition-all">
                        Success Toast
                    </button>
                    <button onclick="showToast('Error! Something went wrong.', 'error')" class="px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:shadow-lg transition-all">
                        Error Toast
                    </button>
                    <button onclick="showToast('Warning! Please check this.', 'warning')" class="px-4 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white font-semibold rounded-lg hover:shadow-lg transition-all">
                        Warning Toast
                    </button>
                    <button onclick="showToast('Info: Here is some information.', 'info')" class="px-4 py-3 bg-gradient-to-r from-orange-500 to-red-600 text-white font-semibold rounded-lg hover:shadow-lg transition-all">
                        Info Toast
                    </button>
                </div>
            </div>
        </section>

        <!-- Typography -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Typography</h2>
            <div class="glass-card rounded-xl p-8 space-y-4">
                <h1 class="text-5xl font-display font-bold text-gray-900">Heading 1 - Display</h1>
                <h2 class="text-4xl font-display font-bold text-gray-900">Heading 2</h2>
                <h3 class="text-3xl font-display font-bold text-gray-900">Heading 3</h3>
                <h4 class="text-2xl font-semibold text-gray-900">Heading 4</h4>
                <p class="text-lg text-gray-700">Large body text - Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <p class="text-base text-gray-700">Regular body text - Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <p class="text-sm text-gray-600">Small text - Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <p class="text-xs text-gray-500">Tiny text - Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </section>
    </div>
</div>
@endsection
