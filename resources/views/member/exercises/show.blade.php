@extends('layouts.app')

@section('title', $exercise->name . ' - Exercise Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-orange-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('member.exercises.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-gray-700 rounded-lg hover:bg-orange-600 hover:text-white transition-all duration-300 shadow-md hover:shadow-xl">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Exercise Library
            </a>
        </div>

        <!-- Exercise Content -->
        @include('member.exercises.partials.show-content', ['exercise' => $exercise])
    </div>
</div>
@endsection
