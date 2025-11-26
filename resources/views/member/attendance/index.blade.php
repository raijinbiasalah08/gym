@extends('layouts.app')

@section('title', 'My Attendance - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">My Attendance</h1>
                <p class="text-sm text-gray-500">Your check-ins and session durations.</p>
            </div>
            <div>
                <a href="{{ route('member.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 text-sm rounded-md hover:bg-gray-50">
                    Back to dashboard
                </a>
            </div>
        </div>

        <form method="get" class="mt-6 flex items-end space-x-3">
            <div>
                <label class="block text-sm font-medium text-gray-700">Start date</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">End date</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>
            <div>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-orange-600 text-white text-sm rounded-md hover:bg-orange-700">Filter</button>
            </div>
            <div>
                <a href="{{ route('member.attendance.export', request()->only(['start_date','end_date'])) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 text-sm rounded-md hover:bg-gray-50">Download CSV</a>
            </div>
        </form>

        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500">Total Visits</dt>
                        <dd class="text-2xl font-semibold text-gray-900">{{ $attendance->total() }}</dd>
                    </dl>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500">Total Duration (min)</dt>
                        <dd class="text-2xl font-semibold text-gray-900">{{ $attendance->sum('workout_duration') }}</dd>
                    </dl>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500">Avg Duration</dt>
                        <dd class="text-2xl font-semibold text-gray-900">{{ $attendance->count() ? round($attendance->avg('workout_duration')) : '0' }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="mt-6 bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Attendance</h3>
                <div class="text-sm text-gray-500">Showing {{ $attendance->count() }} of {{ $attendance->total() }}</div>
            </div>
            <div class="p-6">
                @if($attendance->count() > 0)
                <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check In</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check Out</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration (min)</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($attendance as $att)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($att->date)->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ optional($att->check_in)->format('g:i A') ?? '—' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ optional($att->check_out)->format('g:i A') ?? '—' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $att->workout_duration ?? '—' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Details</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <div class="mt-4">{{ $attendance->withQueryString()->links() }}</div>
                @else
                <p class="text-center py-6 text-gray-500">No attendance records found.</p>
                @endif
            </div>
        </div>

        <div class="mt-6 bg-white shadow rounded-lg p-6">
            <h3 class="text-sm font-medium text-gray-500">Attendance (last 30 days)</h3>
            <canvas id="attendanceChart" class="mt-4" height="120"></canvas>
        </div>
    </div>
</div>
@endsection
