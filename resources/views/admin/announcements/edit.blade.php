@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Edit Announcement</h1>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" value="{{ $announcement->title }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                        <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="info" {{ $announcement->type == 'info' ? 'selected' : '' }}>Info (Blue)</option>
                            <option value="warning" {{ $announcement->type == 'warning' ? 'selected' : '' }}>Warning (Yellow)</option>
                            <option value="danger" {{ $announcement->type == 'danger' ? 'selected' : '' }}>Danger (Red)</option>
                            <option value="success" {{ $announcement->type == 'success' ? 'selected' : '' }}>Success (Green)</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ $announcement->start_date->format('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ $announcement->end_date->format('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea name="message" id="message" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>{{ $announcement->message }}</textarea>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="active" id="active" value="1" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" {{ $announcement->active ? 'checked' : '' }}>
                        <label for="active" class="ml-2 block text-sm text-gray-900">Active</label>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('admin.announcements.index') }}" class="bg-gray-200 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-2">Cancel</a>
                        <button type="submit" class="bg-indigo-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update Announcement</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
