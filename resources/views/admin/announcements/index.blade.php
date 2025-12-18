@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">System Announcements</h1>
            <a href="{{ route('admin.announcements.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                <i class="fas fa-plus mr-2"></i>New Announcement
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($announcements as $announcement)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $announcement->title }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($announcement->message, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($announcement->type == 'info') bg-blue-100 text-blue-800
                                @elseif($announcement->type == 'warning') bg-yellow-100 text-yellow-800
                                @elseif($announcement->type == 'danger') bg-red-100 text-red-800
                                @elseif($announcement->type == 'success') bg-green-100 text-green-800
                                @endif">
                                {{ ucfirst($announcement->type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $announcement->start_date->format('M d, Y') }} - {{ $announcement->end_date->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $announcement->active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $announcement->active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.announcements.edit', $announcement) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
