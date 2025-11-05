@extends('layouts.app')

@section('title', 'Register - GymSystem')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Create your account
            </h2>
        </div>
        
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input id="name" name="name" type="text" required 
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           placeholder="Full Name" value="{{ old('name') }}">
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           placeholder="Email address" value="{{ old('email') }}">
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input id="phone" name="phone" type="tel" required 
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           placeholder="Phone Number" value="{{ old('phone') }}">
                </div>
                
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">I am a</label>
                    <select id="role" name="role" required 
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Select Role</option>
                        <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Member</option>
                        <option value="trainer" {{ old('role') == 'trainer' ? 'selected' : '' }}>Trainer</option>
                    </select>
                </div>
                
                <!-- Trainer Specific Fields -->
                <div id="trainer-fields" class="hidden space-y-4">
                    <div>
                        <label for="specialization" class="block text-sm font-medium text-gray-700">Specialization</label>
                        <input id="specialization" name="specialization" type="text"
                               class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               placeholder="e.g., Personal Training, Yoga" value="{{ old('specialization') }}">
                    </div>
                    
                    <div>
                        <label for="experience_years" class="block text-sm font-medium text-gray-700">Experience (Years)</label>
                        <input id="experience_years" name="experience_years" type="number" min="0"
                               class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               placeholder="Years of experience" value="{{ old('experience_years') }}">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required 
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           placeholder="Password">
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           placeholder="Confirm Password">
                </div>
            </div>

            <div>
                <button type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Create Account
                </button>
            </div>
            
            <div class="text-center">
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500">
                    Already have an account? Sign in
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('role').addEventListener('change', function() {
    const trainerFields = document.getElementById('trainer-fields');
    if (this.value === 'trainer') {
        trainerFields.classList.remove('hidden');
        // Make trainer fields required
        document.getElementById('specialization').required = true;
        document.getElementById('experience_years').required = true;
    } else {
        trainerFields.classList.add('hidden');
        // Remove required from trainer fields
        document.getElementById('specialization').required = false;
        document.getElementById('experience_years').required = false;
    }
});

// Trigger change on page load in case of validation errors
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('role').dispatchEvent(new Event('change'));
});
</script>
@endsection