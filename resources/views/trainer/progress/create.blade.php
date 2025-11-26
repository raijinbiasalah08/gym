@extends('layouts.app')

@section('title', 'Record Progress')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('trainer.progress.index') }}" class="text-orange-600 hover:text-orange-800 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to List
        </a>
    </div>

    <div class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg rounded-xl shadow-lg border border-white border-opacity-20 p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Record New Progress</h1>

        <form action="{{ route('trainer.progress.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Member Selection -->
                <div class="col-span-2">
                    <label for="member_id" class="block text-sm font-medium text-gray-700">Member</label>
                    <select name="member_id" id="member_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm rounded-md bg-white bg-opacity-50">
                        <option value="">Select a member</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>{{ $member->name }} ({{ $member->email }})</option>
                        @endforeach
                    </select>
                    @error('member_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date -->
                <div>
                    <label for="record_date" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="record_date" id="record_date" value="{{ old('record_date', date('Y-m-d')) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-white bg-opacity-50">
                    @error('record_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Basic Metrics -->
                <div>
                    <label for="weight" class="block text-sm font-medium text-gray-700">Weight (kg)</label>
                    <input type="number" step="0.1" name="weight" id="weight" value="{{ old('weight') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-white bg-opacity-50">
                    @error('weight')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="height" class="block text-sm font-medium text-gray-700">Height (cm)</label>
                    <input type="number" step="0.1" name="height" id="height" value="{{ old('height') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-white bg-opacity-50">
                    @error('height')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="body_fat_percentage" class="block text-sm font-medium text-gray-700">Body Fat %</label>
                    <input type="number" step="0.1" name="body_fat_percentage" id="body_fat_percentage" value="{{ old('body_fat_percentage') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-white bg-opacity-50">
                    @error('body_fat_percentage')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Detailed Measurements -->
                <div>
                    <label for="muscle_mass" class="block text-sm font-medium text-gray-700">Muscle Mass (kg)</label>
                    <input type="number" step="0.1" name="muscle_mass" id="muscle_mass" value="{{ old('muscle_mass') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-white bg-opacity-50">
                </div>

                <div>
                    <label for="chest_measurement" class="block text-sm font-medium text-gray-700">Chest (cm)</label>
                    <input type="number" step="0.1" name="chest_measurement" id="chest_measurement" value="{{ old('chest_measurement') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-white bg-opacity-50">
                </div>

                <div>
                    <label for="waist_measurement" class="block text-sm font-medium text-gray-700">Waist (cm)</label>
                    <input type="number" step="0.1" name="waist_measurement" id="waist_measurement" value="{{ old('waist_measurement') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-white bg-opacity-50">
                </div>

                <div>
                    <label for="hip_measurement" class="block text-sm font-medium text-gray-700">Hip (cm)</label>
                    <input type="number" step="0.1" name="hip_measurement" id="hip_measurement" value="{{ old('hip_measurement') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-white bg-opacity-50">
                </div>

                <div>
                    <label for="arm_measurement" class="block text-sm font-medium text-gray-700">Arm (cm)</label>
                    <input type="number" step="0.1" name="arm_measurement" id="arm_measurement" value="{{ old('arm_measurement') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-white bg-opacity-50">
                </div>

                <div>
                    <label for="thigh_measurement" class="block text-sm font-medium text-gray-700">Thigh (cm)</label>
                    <input type="number" step="0.1" name="thigh_measurement" id="thigh_measurement" value="{{ old('thigh_measurement') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-white bg-opacity-50">
                </div>

                <!-- Notes -->
                <div class="col-span-2">
                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                    <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-white bg-opacity-50">{{ old('notes') }}</textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-200">
                    Save Progress
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
