@extends('layouts.app')

@section('title', 'My Progress - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Progress</h1>
                <p class="text-sm text-gray-600 mt-1">Track your fitness journey and body measurements</p>
            </div>
            <!-- Optional: Add a button to request a new measurement from trainer if that flow exists, 
                 but usually trainers add progress. -->
        </div>

        <!-- Stats Overview (Latest) -->
        @if($progress->count() > 0)
            @php
                $latest = $progress->first();
                $previous = $progress->skip(1)->first();
                
                $weightDiff = $previous ? $latest->weight - $previous->weight : 0;
                $fatDiff = $previous ? $latest->body_fat_percentage - $previous->body_fat_percentage : 0;
                $muscleDiff = $previous ? $latest->muscle_mass - $previous->muscle_mass : 0;
            @endphp

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-3 mb-8">
                <!-- Weight Card -->
                <div class="glass-card overflow-hidden rounded-xl transition hover:shadow-lg group">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Current Weight</p>
                                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $latest->weight }} kg</p>
                            </div>
                            <div class="rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 p-3 shadow-lg">
                                <i class="fas fa-weight text-2xl text-white"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            @if($weightDiff < 0)
                                <span class="text-green-600 text-sm font-medium"><i class="fas fa-arrow-down mr-1"></i>{{ abs($weightDiff) }} kg</span>
                                <span class="text-gray-500 text-xs ml-1">since last check</span>
                            @elseif($weightDiff > 0)
                                <span class="text-red-600 text-sm font-medium"><i class="fas fa-arrow-up mr-1"></i>{{ $weightDiff }} kg</span>
                                <span class="text-gray-500 text-xs ml-1">since last check</span>
                            @else
                                <span class="text-gray-500 text-sm">No change</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Body Fat Card -->
                <div class="glass-card overflow-hidden rounded-xl transition hover:shadow-lg group">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Body Fat</p>
                                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $latest->body_fat_percentage }}%</p>
                            </div>
                            <div class="rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 p-3 shadow-lg">
                                <i class="fas fa-percentage text-2xl text-white"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            @if($fatDiff < 0)
                                <span class="text-green-600 text-sm font-medium"><i class="fas fa-arrow-down mr-1"></i>{{ abs($fatDiff) }}%</span>
                                <span class="text-gray-500 text-xs ml-1">since last check</span>
                            @elseif($fatDiff > 0)
                                <span class="text-red-600 text-sm font-medium"><i class="fas fa-arrow-up mr-1"></i>{{ $fatDiff }}%</span>
                                <span class="text-gray-500 text-xs ml-1">since last check</span>
                            @else
                                <span class="text-gray-500 text-sm">No change</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Muscle Mass Card -->
                <div class="glass-card overflow-hidden rounded-xl transition hover:shadow-lg group">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Muscle Mass</p>
                                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $latest->muscle_mass }} kg</p>
                            </div>
                            <div class="rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 p-3 shadow-lg">
                                <i class="fas fa-dumbbell text-2xl text-white"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            @if($muscleDiff > 0)
                                <span class="text-green-600 text-sm font-medium"><i class="fas fa-arrow-up mr-1"></i>{{ $muscleDiff }} kg</span>
                                <span class="text-gray-500 text-xs ml-1">since last check</span>
                            @elseif($muscleDiff < 0)
                                <span class="text-red-600 text-sm font-medium"><i class="fas fa-arrow-down mr-1"></i>{{ abs($muscleDiff) }} kg</span>
                                <span class="text-gray-500 text-xs ml-1">since last check</span>
                            @else
                                <span class="text-gray-500 text-sm">No change</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Progress History List -->
        <div class="glass-card rounded-xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 border-opacity-50">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-history text-blue-600 mr-2"></i>
                    Progress History
                </h3>
            </div>

            @if($progress->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 divide-opacity-30">
                        <thead class="bg-white bg-opacity-40">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Weight
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Body Fat
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Muscle Mass
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    BMI
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 divide-opacity-30">
                            @foreach($progress as $record)
                            <tr class="hover:bg-white hover:bg-opacity-30 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $record->record_date->format('M d, Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $record->record_date->diffForHumans() }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $record->weight }} kg</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $record->body_fat_percentage }}%</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $record->muscle_mass }} kg</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $record->bmi }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('member.progress.show', $record) }}" 
                                       class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 border-t border-gray-200 border-opacity-50">
                    {{ $progress->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-full p-6 w-24 h-24 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chart-line text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No progress records found</h3>
                    <p class="text-sm text-gray-600 mb-6">
                        Your trainer hasn't added any progress records yet. Check back later after your assessment!
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
