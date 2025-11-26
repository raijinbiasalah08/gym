@extends('layouts.app')

@section('title', 'Forgot Password - GymSystem')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">
        <div class="glass-card py-8 px-6 rounded-xl shadow-2xl">
            <div class="text-center mb-8">
                <a href="{{ url('/') }}" class="inline-flex items-center text-3xl font-bold text-gray-900">
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-orange-600 to-red-600 flex items-center justify-center shadow-lg shadow-orange-500/50 mr-3">
                        <i class="fas fa-dumbbell text-white text-xl"></i>
                    </div>
                    Titans Gym
                </a>
                <h2 class="mt-6 text-center text-2xl font-bold text-gray-900">Forgot Password?</h2>
                <p class="mt-2 text-sm text-gray-600">No worries! Enter your email and we'll send you reset instructions.</p>
            </div>

            @if(session('status'))
                <div class="mb-6 bg-green-50 bg-opacity-90 border border-green-200 text-green-700 px-4 py-3 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span class="font-semibold">{{ session('status') }}</span>
                    </div>
                </div>
            @endif

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

            <form class="space-y-6" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="w-full pl-10 pr-4 py-3 glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all"
                               placeholder="you@example.com" value="{{ old('email') }}">
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-sm font-bold text-white bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 hover:shadow-orange-500/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transform hover:-translate-y-0.5 transition-all duration-200">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Send Password Reset Link
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Remember your password? 
                    <a href="{{ route('login') }}" class="font-medium text-orange-600 hover:text-orange-500 transition">
                        Back to login
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
