@extends('layouts.app')

@section('title', 'Booking Calendar - GymSystem')

@section('styles')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<style>
    .fc-event {
        cursor: pointer;
    }
    .fc-day-today {
        background-color: #f0f9ff !important;
    }
</style>
@endsection

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Booking Calendar</h1>
            <div class="space-x-2">
                <a href="{{ route('trainer.bookings.index') }}" 
                   class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                    <i class="fas fa-list mr-2"></i>List View
                </a>
            </div>
        </div>

        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="p-6">
                <div id="calendar" class="mt-4"></div>
            </div>
        </div>

        <!-- Legend -->
        <div class="mt-4 bg-white shadow rounded-lg p-4">
            <h3 class="text-lg font-medium text-gray-900 mb-3">Session Types</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-blue-500 rounded mr-2"></div>
                    <span class="text-sm text-gray-700">Personal Training</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-green-500 rounded mr-2"></div>
                    <span class="text-sm text-gray-700">Group Session</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-purple-500 rounded mr-2"></div>
                    <span class="text-sm text-gray-700">Consultation</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: @json($bookings),
        eventClick: function(info) {
            // Redirect to booking details page
            window.location.href = "{{ url('trainer/bookings') }}/" + info.event.id;
        },
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        },
        slotMinTime: '06:00:00',
        slotMaxTime: '22:00:00',
        allDaySlot: false,
        nowIndicator: true,
        navLinks: true,
        businessHours: {
            daysOfWeek: [1, 2, 3, 4, 5, 6],
            startTime: '06:00',
            endTime: '22:00',
        },
        height: 'auto',
        slotDuration: '01:00:00',
        slotLabelInterval: '01:00'
    });
    calendar.render();
});
</script>
@endsection