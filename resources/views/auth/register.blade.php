
@extends('layouts.app')

@section('title', 'Join GymSystem - Start Your Journey')

@section('content')
<div class="min-h-screen flex">
    <!-- Left Side - Image & Motivation -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-gray-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470&auto=format&fit=crop" 
                 alt="Gym Motivation" 
                 class="w-full h-full object-cover opacity-60">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
        
        <div class="relative z-10 flex flex-col justify-end p-16 text-white">
            <div class="mb-8">
                <div class="h-16 w-16 rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center shadow-lg mb-6">
                    <i class="fas fa-dumbbell text-3xl"></i>
                </div>
                <h1 class="text-5xl font-bold font-display mb-4 leading-tight">
                    Transform Your <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-red-500">Body & Mind</span>
                </h1>
                <p class="text-xl text-gray-300 max-w-md leading-relaxed">
                    Join our community of fitness enthusiasts and professional trainers. Your journey to a better you starts here.
                </p>
            </div>
            
            <div class="flex items-center space-x-4 text-sm text-gray-400">
                <div class="flex -space-x-2">
                    <img class="w-8 h-8 rounded-full border-2 border-gray-900" src="https://i.pravatar.cc/100?img=1" alt="User">
                    <img class="w-8 h-8 rounded-full border-2 border-gray-900" src="https://i.pravatar.cc/100?img=2" alt="User">
                    <img class="w-8 h-8 rounded-full border-2 border-gray-900" src="https://i.pravatar.cc/100?img=3" alt="User">
                    <div class="w-8 h-8 rounded-full border-2 border-gray-900 bg-gray-800 flex items-center justify-center text-xs font-medium text-white">
                        +2k
                    </div>
                </div>
                <span>Join 2,000+ members today</span>
            </div>
        </div>
    </div>

    <!-- Right Side - Registration Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-16 bg-gray-50">
        <div class="w-full max-w-md space-y-8">
            <div class="text-center lg:text-left">
                <h2 class="text-3xl font-bold text-gray-900 font-display">Create Account</h2>
                <p class="mt-2 text-gray-600">
                    Already a member? 
                    <a href="{{ route('login') }}" class="font-medium text-orange-600 hover:text-orange-500 transition-colors">
                        Sign in
                    </a>
                </p>
            </div>

            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg animate-fade-in">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                
                <div class="space-y-5">
                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input id="name" name="name" type="text" required value="{{ old('name') }}"
                                   class="block w-full pl-10 pr-3 py-3 border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 sm:text-sm transition-colors" 
                                   placeholder="John Doe">
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                                   class="block w-full pl-10 pr-3 py-3 border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 sm:text-sm transition-colors" 
                                   placeholder="you@example.com">
                        </div>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <input id="phone" name="phone" type="tel" required value="{{ old('phone') }}"
                                   class="block w-full pl-10 pr-3 py-3 border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 sm:text-sm transition-colors" 
                                   placeholder="+1 (555) 000-0000">
                        </div>
                    </div>

                    <!-- Sex -->
                    <div>
                        <label for="sex" class="block text-sm font-medium text-gray-700 mb-1">Sex</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative flex flex-col items-center p-4 border-2 rounded-xl cursor-pointer hover:bg-orange-50 hover:border-orange-200 transition-all group">
                                <input type="radio" name="sex" value="male" class="peer sr-only" {{ old('sex') == 'male' ? 'checked' : '' }} required>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-orange-500 rounded-xl pointer-events-none"></div>
                                <i class="fas fa-mars text-2xl text-gray-400 peer-checked:text-orange-500 mb-2 group-hover:text-orange-500 transition-colors"></i>
                                <span class="text-sm font-medium text-gray-900 peer-checked:text-orange-600">Male</span>
                            </label>
                            
                            <label class="relative flex flex-col items-center p-4 border-2 rounded-xl cursor-pointer hover:bg-orange-50 hover:border-orange-200 transition-all group">
                                <input type="radio" name="sex" value="female" class="peer sr-only" {{ old('sex') == 'female' ? 'checked' : '' }} required>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-orange-500 rounded-xl pointer-events-none"></div>
                                <i class="fas fa-venus text-2xl text-gray-400 peer-checked:text-orange-500 mb-2 group-hover:text-orange-500 transition-colors"></i>
                                <span class="text-sm font-medium text-gray-900 peer-checked:text-orange-600">Female</span>
                            </label>
                        </div>
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar text-gray-400"></i>
                            </div>
                            <input id="date_of_birth" name="date_of_birth" type="date" required value="{{ old('date_of_birth') }}"
                                   max="{{ date('Y-m-d', strtotime('-13 years')) }}"
                                   class="block w-full pl-10 pr-3 py-3 border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 sm:text-sm transition-colors">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">You must be at least 13 years old to register</p>
                    </div>

                    <!-- Role Selection -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">I want to join as</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative flex flex-col items-center p-4 border-2 rounded-xl cursor-pointer hover:bg-orange-50 hover:border-orange-200 transition-all group">
                                <input type="radio" name="role" value="member" class="peer sr-only" {{ old('role') == 'member' || !old('role') ? 'checked' : '' }}>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-orange-500 rounded-xl pointer-events-none"></div>
                                <i class="fas fa-user text-2xl text-gray-400 peer-checked:text-orange-500 mb-2 group-hover:text-orange-500 transition-colors"></i>
                                <span class="text-sm font-medium text-gray-900 peer-checked:text-orange-600">Member</span>
                            </label>
                            
                            <label class="relative flex flex-col items-center p-4 border-2 rounded-xl cursor-pointer hover:bg-orange-50 hover:border-orange-200 transition-all group">
                                <input type="radio" name="role" value="trainer" class="peer sr-only" {{ old('role') == 'trainer' ? 'checked' : '' }}>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-orange-500 rounded-xl pointer-events-none"></div>
                                <i class="fas fa-dumbbell text-2xl text-gray-400 peer-checked:text-orange-500 mb-2 group-hover:text-orange-500 transition-colors"></i>
                                <span class="text-sm font-medium text-gray-900 peer-checked:text-orange-600">Trainer</span>
                            </label>
                        </div>
                    </div>

                    <!-- Dynamic Fields Container -->
                    <div id="dynamic-fields" class="space-y-5 animate-fade-in">
                        <!-- Member Fields -->
                        <div id="member-fields" class="{{ old('role') == 'trainer' ? 'hidden' : '' }}">
                            <label for="membership_type" class="block text-sm font-medium text-gray-700 mb-1">Membership Plan</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-id-card text-gray-400"></i>
                                </div>
                                <select id="membership_type" name="membership_type" 
                                        class="block w-full pl-10 pr-10 py-3 border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 sm:text-sm appearance-none transition-colors">
                                    <option value="basic" {{ old('membership_type') == 'basic' ? 'selected' : '' }}>Basic Plan</option>
                                    <option value="premium" {{ old('membership_type') == 'premium' ? 'selected' : '' }}>Premium Plan</option>
                                    <option value="vip" {{ old('membership_type') == 'vip' ? 'selected' : '' }}>VIP Access</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Trainer Fields -->
                        <div id="trainer-fields" class="{{ old('role') == 'trainer' ? '' : 'hidden' }} space-y-5">
                            <div>
                                <label for="specialization" class="block text-sm font-medium text-gray-700 mb-1">Specialization</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-certificate text-gray-400"></i>
                                    </div>
                                    <input id="specialization" name="specialization" type="text" value="{{ old('specialization') }}"
                                           class="block w-full pl-10 pr-3 py-3 border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 sm:text-sm transition-colors" 
                                           placeholder="e.g. Yoga, HIIT, Strength">
                                </div>
                            </div>
                            
                            <div>
                                <label for="experience_years" class="block text-sm font-medium text-gray-700 mb-1">Years of Experience</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-history text-gray-400"></i>
                                    </div>
                                    <input id="experience_years" name="experience_years" type="number" min="0" value="{{ old('experience_years') }}"
                                           class="block w-full pl-10 pr-3 py-3 border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 sm:text-sm transition-colors" 
                                           placeholder="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Password Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="password" name="password" type="password" required 
                                       class="block w-full pl-10 pr-3 py-3 border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 sm:text-sm transition-colors"
                                       placeholder="••••••••">
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="password_confirmation" name="password_confirmation" type="password" required 
                                       class="block w-full pl-10 pr-3 py-3 border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 sm:text-sm transition-colors"
                                       placeholder="••••••••">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-gradient-to-r from-orange-600 to-red-700 hover:from-orange-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transform transition-all duration-200 hover:scale-[1.02] shadow-lg hover:shadow-xl">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-arrow-right text-orange-300 group-hover:text-white transition-colors"></i>
                        </span>
                        Create Account
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-gray-50 text-gray-500">
                            Or continue with
                        </span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <a href="#" class="w-full inline-flex justify-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors">
                        <i class="fab fa-google text-red-500 text-lg"></i>
                    </a>
                    <a href="#" class="w-full inline-flex justify-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors">
                        <i class="fab fa-facebook text-blue-600 text-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const roleInputs = document.querySelectorAll('input[name="role"]');
    const trainerFields = document.getElementById('trainer-fields');
    const memberFields = document.getElementById('member-fields');
    const specializationInput = document.getElementById('specialization');
    const experienceInput = document.getElementById('experience_years');
    const membershipInput = document.getElementById('membership_type');

    function updateFields(role) {
        if (role === 'trainer') {
            trainerFields.classList.remove('hidden');
            memberFields.classList.add('hidden');
            
            specializationInput.required = true;
            experienceInput.required = true;
            membershipInput.required = false;
        } else {
            trainerFields.classList.add('hidden');
            memberFields.classList.remove('hidden');
            
            specializationInput.required = false;
            experienceInput.required = false;
            membershipInput.required = true;
        }
    }

    roleInputs.forEach(input => {
        input.addEventListener('change', (e) => updateFields(e.target.value));
    });

    // Initialize based on current selection
    const checkedRole = document.querySelector('input[name="role"]:checked');
    if (checkedRole) {
        updateFields(checkedRole.value);
    }
});
</script>
@endsection
