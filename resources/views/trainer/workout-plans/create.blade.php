@extends('layouts.app')

@section('title', 'Create Workout Plan - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Create Workout Plan</h1>
            <a href="{{ route('trainer.workout-plans.index') }}" 
               class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                <i class="fas fa-arrow-left mr-2"></i>Back to Plans
            </a>
        </div>

        @if($errors->any())
            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
            <form action="{{ route('trainer.workout-plans.store') }}" method="POST" id="workoutPlanForm">
                @csrf
                <input type="hidden" name="schedule_data" id="scheduleData">
                
                <div class="px-4 py-5 sm:p-6 space-y-6">
                    <!-- Basic Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="member_id" class="block text-sm font-medium text-gray-700">Member *</label>
                            <select name="member_id" id="member_id" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select a member</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                        {{ $member->name }} ({{ $member->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Plan Title *</label>
                            <input type="text" name="title" id="title" required value="{{ old('title') }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="e.g., Weight Gain Program">
                        </div>

                        <div>
                            <label for="goal" class="block text-sm font-medium text-gray-700">Goal *</label>
                            <input type="text" name="goal" id="goal" required value="{{ old('goal') }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="e.g., Gain muscle, Lose weight, Improve endurance">
                        </div>

                        <div>
                            <label for="duration_weeks" class="block text-sm font-medium text-gray-700">Duration (Weeks) *</label>
                            <input type="number" name="duration_weeks" id="duration_weeks" required min="1" max="52" value="{{ old('duration_weeks') }}"
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="e.g., 12">
                        </div>

                        <div>
                            <label for="difficulty_level" class="block text-sm font-medium text-gray-700">Difficulty Level *</label>
                            <select name="difficulty_level" id="difficulty_level" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="beginner" {{ old('difficulty_level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="intermediate" {{ old('difficulty_level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="advanced" {{ old('difficulty_level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                            </select>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                            <select name="status" id="status" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description *</label>
                        <textarea name="description" id="description" rows="3" required
                                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Describe the workout plan...">{{ old('description') }}</textarea>
                    </div>

                    <!-- DRAG AND DROP BUILDER -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Workout Scheduler</h3>
                        <p class="text-sm text-gray-500 mb-4">Drag exercises from the left library into the daily slots on the right.</p>

                        <div class="flex flex-col lg:flex-row gap-6 lg:h-[800px] h-auto">
                            <!-- Left Column: Exercise Library -->
                            <div class="w-full lg:w-1/3 flex flex-col bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700 lg:h-full h-[500px]">
                                <div class="p-3 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 rounded-t-lg">
                                    <h4 class="font-semibold text-gray-700 dark:text-gray-200">Exercise Library</h4>
                                    <input type="text" id="exerciseSearch" placeholder="Search exercises..." class="mt-2 text-sm w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md">
                                </div>
                                <div class="flex-1 overflow-y-auto p-3 space-y-4 custom-scrollbar" id="exerciseLibrary">
                                    @foreach($exercises as $category => $categoryExercises)
                                        <div class="category-group">
                                            <h5 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2 py-1">{{ ucfirst($category) }}</h5>
                                            <div class="space-y-2">
                                                @foreach($categoryExercises as $exercise)
                                                    <div class="exercise-card bg-white dark:bg-gray-800 p-3 rounded shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md hover:border-blue-300 dark:hover:border-blue-500 transition-all flex items-center justify-between group" 
                                                         draggable="true" 
                                                         data-id="{{ $exercise->id }}" 
                                                         data-name="{{ $exercise->name }}">
                                                        <div class="flex items-center gap-2">
                                                            <i class="fas fa-grip-vertical text-gray-300 dark:text-gray-600 cursor-move hidden lg:block"></i>
                                                            <span class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $exercise->name }}</span>
                                                        </div>
                                                        <button type="button" class="lg:hidden text-blue-500 hover:text-blue-700 p-1" onclick="openDayModal('{{ $exercise->id }}', '{{ $exercise->name }}')">
                                                            <i class="fas fa-plus-circle text-lg"></i>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Right Column: Weekly Schedule -->
                            <div class="w-full lg:w-2/3 flex-1 overflow-y-auto bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-inner p-4 lg:h-full h-auto min-h-[500px] custom-scrollbar">
                                <div class="grid grid-cols-1 gap-6">
                                    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                        <div class="day-container bg-gray-50 dark:bg-gray-900 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 min-h-[150px]" id="day-{{ strtolower($day) }}" data-day="{{ strtolower($day) }}">
                                            <div class="bg-gray-200 dark:bg-gray-700 px-3 py-2 rounded-t-lg flex justify-between items-center">
                                                <h4 class="font-bold text-gray-700 dark:text-gray-200">{{ $day }}</h4>
                                                <span class="text-xs text-gray-500 dark:text-gray-400 exercise-count">0 exercises</span>
                                            </div>
                                            <div class="p-2 space-y-2 day-drop-zone min-h-[100px]" ondragover="event.preventDefault()">
                                                <!-- Dropped exercises go here -->
                                                <div class="placeholder text-center text-gray-400 dark:text-gray-500 text-sm py-4 italic pointer-events-none">
                                                    Drop exercises here
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="pt-6 border-t border-gray-200 flex justify-end space-x-3">
                        <a href="{{ route('trainer.workout-plans.index') }}" 
                           class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                            Cancel
                        </a>
                        <button type="submit" onclick="prepareScheduleData()"
                                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                            Create Workout Plan
                        </button>
                    </div>
                </div>
            </form>

            <!-- Mobile Day Selection Modal -->
            <div id="daySelectionModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeDayModal()"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full">
                        <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 mb-4" id="modal-title">Add to Day</h3>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                    <button type="button" onclick="addExerciseToDay('{{ strtolower($day) }}')" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">
                                        {{ $day }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeDayModal()">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            @push('scripts')
            <script>
                let selectedExercise = null;

                function openDayModal(id, name) {
                    selectedExercise = { id, name };
                    document.getElementById('daySelectionModal').classList.remove('hidden');
                }

                function closeDayModal() {
                    document.getElementById('daySelectionModal').classList.add('hidden');
                    selectedExercise = null;
                }

                function addExerciseToDay(day) {
                    if (!selectedExercise) return;

                    const container = document.querySelector(`#day-${day} .day-drop-zone`);
                    
                    // Remove placeholder if exists
                    const placeholder = container.querySelector('.placeholder');
                    if(placeholder) placeholder.remove();

                    // Create new element
                    const newEl = document.createElement('div');
                    newEl.className = 'bg-white p-3 rounded shadow-sm border border-gray-200 flex flex-col gap-2 group relative';
                    newEl.dataset.exerciseId = selectedExercise.id;
                    newEl.innerHTML = `
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-sm">${selectedExercise.name}</span>
                            <button type="button" class="text-red-400 hover:text-red-600" onclick="this.closest('div.bg-white').remove(); updateCounts();">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div>
                                <label class="block text-gray-500">Sets</label>
                                <input type="number" class="w-full border-gray-300 rounded px-1 py-0.5" value="3" min="1">
                            </div>
                            <div>
                                <label class="block text-gray-500">Reps</label>
                                <input type="text" class="w-full border-gray-300 rounded px-1 py-0.5" value="10-12">
                            </div>
                        </div>
                    `;
                    
                    container.appendChild(newEl);
                    updateCounts();
                    closeDayModal();
                    
                    // Optional: Scroll to that day
                    // document.getElementById(`day-${day}`).scrollIntoView({ behavior: 'smooth', block: 'center' });
                }

                document.addEventListener('DOMContentLoaded', function() {
                    const draggables = document.querySelectorAll('.exercise-card');
                    const containers = document.querySelectorAll('.day-drop-zone');
                    const searchInput = document.getElementById('exerciseSearch');

                    // Search Functionality
                    searchInput.addEventListener('input', function(e) {
                        const term = e.target.value.toLowerCase();
                        document.querySelectorAll('.exercise-card').forEach(card => {
                            const name = card.querySelector('span').textContent.toLowerCase();
                            if(name.includes(term)) {
                                card.style.display = 'flex';
                            } else {
                                card.style.display = 'none';
                            }
                        });
                    });

                    // Drag Events
                    draggables.forEach(draggable => {
                        draggable.addEventListener('dragstart', () => {
                            draggable.classList.add('opacity-50');
                            // Store data to transfer
                            event.dataTransfer.setData('text/plain', JSON.stringify({
                                id: draggable.dataset.id,
                                name: draggable.dataset.name
                            }));
                        });

                        draggable.addEventListener('dragend', () => {
                            draggable.classList.remove('opacity-50');
                        });
                    });

                    containers.forEach(container => {
                        container.addEventListener('dragover', e => {
                            e.preventDefault();
                            container.classList.add('bg-blue-50', 'border-blue-300');
                        });

                        container.addEventListener('dragleave', e => {
                            container.classList.remove('bg-blue-50', 'border-blue-300');
                        });

                        container.addEventListener('drop', e => {
                            e.preventDefault();
                            container.classList.remove('bg-blue-50', 'border-blue-300');
                            
                            // Remove placeholder if exists
                            const placeholder = container.querySelector('.placeholder');
                            if(placeholder) placeholder.remove();

                            const data = JSON.parse(e.dataTransfer.getData('text/plain'));
                            
                            // Create new element for the dropped item
                            const newEl = document.createElement('div');
                            newEl.className = 'bg-white p-3 rounded shadow-sm border border-gray-200 flex flex-col gap-2 group relative';
                            newEl.dataset.exerciseId = data.id;
                            newEl.innerHTML = `
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold text-sm">${data.name}</span>
                                    <button type="button" class="text-red-400 hover:text-red-600" onclick="this.closest('div.bg-white').remove(); updateCounts();">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <div>
                                        <label class="block text-gray-500">Sets</label>
                                        <input type="number" class="w-full border-gray-300 rounded px-1 py-0.5" value="3" min="1">
                                    </div>
                                    <div>
                                        <label class="block text-gray-500">Reps</label>
                                        <input type="text" class="w-full border-gray-300 rounded px-1 py-0.5" value="10-12">
                                    </div>
                                </div>
                            `;
                            
                            container.appendChild(newEl);
                            updateCounts();
                        });
                    });
                });

                function updateCounts() {
                    document.querySelectorAll('.day-container').forEach(day => {
                        const count = day.querySelectorAll('.day-drop-zone > div:not(.placeholder)').length;
                        day.querySelector('.exercise-count').textContent = `${count} exercises`;
                    });
                }

                function prepareScheduleData() {
                    const schedule = {};
                    
                    document.querySelectorAll('.day-container').forEach(day => {
                        const dayName = day.dataset.day;
                        const exercises = [];
                        
                        day.querySelectorAll('.day-drop-zone > div:not(.placeholder)').forEach(ex => {
                            const inputs = ex.querySelectorAll('input');
                            exercises.push({
                                exercise_id: ex.dataset.exerciseId,
                                exercise_name: ex.querySelector('span').textContent,
                                sets: inputs[0].value,
                                reps: inputs[1].value
                            });
                        });
                        
                        if(exercises.length > 0) {
                            schedule[dayName] = exercises;
                        }
                    });
                    
                    document.getElementById('scheduleData').value = JSON.stringify(schedule);
                }
            </script>
            @endpush
        </div>
    </div>
</div>
@endsection