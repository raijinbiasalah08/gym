@extends('layouts.app')

@section('title', 'Register - GymSystem')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-lg">
        <div class="glass-card py-8 px-6 rounded-xl shadow-2xl">
            <div class="text-center mb-8">
                <a href="{{ url('/') }}" class="inline-flex items-center text-3xl font-bold text-gray-900">
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg mr-3">
                        <i class="fas fa-dumbbell text-white text-xl"></i>
                    </div>
                    GymSystem
                </a>
                <h2 class="mt-6 text-center text-2xl font-bold text-gray-900">Create Account</h2>
                <p class="mt-2 text-sm text-gray-600">Join us and start your fitness journey</p>
            </div>

            @if($errors->any())
                <div class="mb-6 bg-red-50 bg-opacity-90 border border-red-200 text-red-700 px-4 py-3 rounded-lg shadow-sm">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span class="font-semibold">Please check your input:</span>
                    </div>
                    <ul class="list-disc list-inside text-sm ml-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input id="name" name="name" type="text" required value="{{ old('name') }}"
                                   class="w-full pl-10 pr-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" 
                                   placeholder="John Doe">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                                   class="w-full pl-10 pr-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" 
                                   placeholder="you@example.com">
                        </div>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <input id="phone" name="phone" type="tel" required value="{{ old('phone') }}"
                                   class="w-full pl-10 pr-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" 
                                   placeholder="+1 (555) 000-0000">
                        </div>
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">I am a</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user-tag text-gray-400"></i>
                            </div>
                            <select id="role" name="role" required 
                                    class="w-full pl-10 pr-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all appearance-none">
                                <option value="">Select Role</option>
                                <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Member</option>
                                <option value="trainer" {{ old('role') == 'trainer' ? 'selected' : '' }}>Trainer</option>
                            </select>
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password" name="password" type="password" required 
                                   class="w-full pl-10 pr-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                                   placeholder="••••••••">
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password_confirmation" name="password_confirmation" type="password" required 
                                   class="w-full pl-10 pr-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                                   placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform hover:-translate-y-0.5 transition-all duration-200">
                        Create Account
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500 transition">
                            Sign in
                        </a>
                    </p>
@extends('layouts.app')

@section('title', 'Register - GymSystem')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-lg">
        <div class="glass-card py-8 px-6 rounded-xl shadow-2xl">
            <div class="text-center mb-8">
                <a href="{{ url('/') }}" class="inline-flex items-center text-3xl font-bold text-gray-900">
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg mr-3">
                        <i class="fas fa-dumbbell text-white text-xl"></i>
                    </div>
                    GymSystem
                </a>
                <h2 class="mt-6 text-center text-2xl font-bold text-gray-900">Create Account</h2>
                <p class="mt-2 text-sm text-gray-600">Join us and start your fitness journey</p>
            </div>

            @if($errors->any())
                <div class="mb-6 bg-red-50 bg-opacity-90 border border-red-200 text-red-700 px-4 py-3 rounded-lg shadow-sm">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span class="font-semibold">Please check your input:</span>
                    </div>
                    <ul class="list-disc list-inside text-sm ml-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input id="name" name="name" type="text" required value="{{ old('name') }}"
                                   class="w-full pl-10 pr-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" 
                                   placeholder="John Doe">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                                   class="w-full pl-10 pr-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" 
                                   placeholder="you@example.com">
                        </div>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <input id="phone" name="phone" type="tel" required value="{{ old('phone') }}"
                                   class="w-full pl-10 pr-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" 
                                   placeholder="+1 (555) 000-0000">
                        </div>
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">I am a</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user-tag text-gray-400"></i>
                            </div>
                            <select id="role" name="role" required 
                                    class="w-full pl-10 pr-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all appearance-none">
                                <option value="">Select Role</option>
                                <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Member</option>
                                <option value="trainer" {{ old('role') == 'trainer' ? 'selected' : '' }}>Trainer</option>
                            </select>
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password" name="password" type="password" required 
                                   class="w-full pl-10 pr-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                                   placeholder="••••••••">
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password_confirmation" name="password_confirmation" type="password" required 
                                   class="w-full pl-10 pr-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                                   placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform hover:-translate-y-0.5 transition-all duration-200">
                        Create Account
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500 transition">
                            Sign in
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('role')?.addEventListener('change', function() {
    const trainerFields = document.getElementById('trainer-fields');
    const memberFields = document.getElementById('member-fields');
    
    if (!trainerFields || !memberFields) return;
    
    if (this.value === 'trainer') {
        trainerFields.classList.remove('hidden');
        memberFields.classList.add('hidden');
        
        document.getElementById('specialization').required = true;
        document.getElementById('experience_years').required = true;
        document.getElementById('membership_type').required = false;
    } else if (this.value === 'member') {
        trainerFields.classList.add('hidden');
        memberFields.classList.remove('hidden');
        
        document.getElementById('specialization').required = false;
        document.getElementById('experience_years').required = false;
        document.getElementById('membership_type').required = true;
    } else {
        trainerFields.classList.add('hidden');
        memberFields.classList.add('hidden');
        
        document.getElementById('specialization').required = false;
        document.getElementById('experience_years').required = false;
        document.getElementById('membership_type').required = false;
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const role = document.getElementById('role');
    if (role) role.dispatchEvent(new Event('change'));
});
</script>
@endsection