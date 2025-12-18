@extends('layouts.app')

@section('title', 'My Progress - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">My Progress Tracker</h1>

        <!-- Chart Section -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Weight History</h3>
                <div class="h-64">
                    <canvas id="weightChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Add New Log Form -->
            <div class="md:col-span-1">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Log Today's Stats</h3>
                        <form action="{{ route('member.progress.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label for="log_date" class="block text-sm font-medium text-gray-700">Date</label>
                                    <input type="date" name="log_date" id="log_date" value="{{ date('Y-m-d') }}" required
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="weight" class="block text-sm font-medium text-gray-700">Weight (kg) *</label>
                                    <input type="number" name="weight" id="weight" step="0.1" required
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="body_fat_percentage" class="block text-sm font-medium text-gray-700">Body Fat % (Optional)</label>
                                    <input type="number" name="body_fat_percentage" id="body_fat_percentage" step="0.1"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="photo" class="block text-sm font-medium text-gray-700">Progress Photo (Optional)</label>
                                    <input type="file" name="photo" id="photo" accept="image/*"
                                           class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                </div>
                                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm font-medium">
                                    Save Log
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- History & Photos -->
            <div class="md:col-span-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Logs</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Body Fat</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($logs->sortByDesc('log_date') as $log)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $log->log_date->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $log->weight }} kg
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $log->body_fat_percentage ? $log->body_fat_percentage . '%' : '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <form action="{{ route('member.progress.destroy', $log) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No logs yet. Start tracking today!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Photo Gallery -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Progress Photos</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @forelse($logs->whereNotNull('photo_path') as $log)
                                <div class="relative group aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100">
                                    <img src="{{ Storage::url($log->photo_path) }}" alt="Progress on {{ $log->log_date->format('M d') }}" class="object-cover w-full h-full">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-opacity flex items-end">
                                        <div class="p-2 text-white opacity-0 group-hover:opacity-100 text-xs w-full bg-gradient-to-t from-black/60">
                                            {{ $log->log_date->format('M d, Y') }} • {{ $log->weight }}kg
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="col-span-3 text-sm text-gray-500 text-center py-4">No photos uploaded yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('weightChart').getContext('2d');
        const logs = @json($logs);
        
        const labels = logs.map(log => new Date(log.log_date).toLocaleDateString(undefined, { month: 'short', day: 'numeric' }));
        const data = logs.map(log => log.weight);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Weight (kg)',
                    data: data,
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.1,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
    });
</script>
@endsection
