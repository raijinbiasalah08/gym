@extends('layouts.app')

@section('title', 'Progress Details')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('trainer.progress.index') }}" class="text-orange-600 hover:text-orange-800 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to List
        </a>
        <div class="flex space-x-3">
            <a href="{{ route('trainer.progress.edit', $progress) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-200">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <form action="{{ route('trainer.progress.destroy', $progress) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-200" onclick="return confirm('Are you sure?')">
                    <i class="fas fa-trash mr-2"></i> Delete
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg rounded-xl shadow-lg border border-white border-opacity-20 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 bg-opacity-50">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Progress Record: {{ $progress->member->name }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Recorded on {{ $progress->record_date->format('F d, Y') }}
            </p>
        </div>
        <div class="px-6 py-4">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Weight</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $progress->weight }} kg</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Height</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $progress->height }} cm</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">BMI</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $progress->bmi < 18.5 ? 'bg-yellow-100 text-yellow-800' : 
                               ($progress->bmi < 25 ? 'bg-green-100 text-green-800' : 
                               ($progress->bmi < 30 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')) }}">
                            {{ $progress->bmi }}
                        </span>
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Body Fat %</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $progress->body_fat_percentage ?? 'N/A' }}%</dd>
                </div>
                
                <div class="sm:col-span-2 border-t border-gray-200 pt-4 mt-2">
                    <h4 class="text-md font-medium text-gray-900 mb-2">Measurements</h4>
                </div>

                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Muscle Mass</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $progress->muscle_mass ?? '-' }} kg</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Chest</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $progress->chest_measurement ?? '-' }} cm</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Waist</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $progress->waist_measurement ?? '-' }} cm</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Hip</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $progress->hip_measurement ?? '-' }} cm</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Arm</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $progress->arm_measurement ?? '-' }} cm</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Thigh</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $progress->thigh_measurement ?? '-' }} cm</dd>
                </div>

                <div class="sm:col-span-2 border-t border-gray-200 pt-4 mt-2">
                    <dt class="text-sm font-medium text-gray-500">Notes</dt>
                    <dd class="mt-1 text-sm text-gray-900 bg-gray-50 bg-opacity-50 p-3 rounded-md">
                        {{ $progress->notes ?? 'No notes recorded.' }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection
