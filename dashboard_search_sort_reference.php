<?php
// This file adds search and sort to dashboard directory widgets
// Copy the content below and manually add to dashboard.blade.php

/*
STEP 1: Replace Members Directory header (around line 317-323) with:
*/
?>
                <div class="px-6 py-4 border-b border-gray-200 border-opacity-50">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-users text-orange-600 mr-2"></i>
                            Members Directory
                        </h3>
                        <span class="text-sm text-gray-500">{{ $allMembers->count() }} members</span>
                    </div>
                    <!-- Search and Sort -->
                    <div class="flex gap-2">
                        <div class="relative flex-1">
                            <input type="text" 
                                id="searchMembers" 
                                placeholder="Search members..." 
                                class="w-full px-3 py-2 pl-9 text-sm glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                        </div>
                        <select id="sortMembers" class="px-3 py-2 text-sm glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all">
                            <option value="name">All Members</option>
                            <option value="basic">Basic</option>
                            <option value="premium">Premium</option>
                            <option value="vip">VIP</option>
                        </select>
                    </div>
                </div>
                <div class="divide-y divide-gray-200 divide-opacity-30 max-h-96 overflow-y-auto" id="membersListContainer">

<?php
/*
STEP 2: Replace Trainers Directory header (around line 359-365) with:
*/
?>
                <div class="px-6 py-4 border-b border-gray-200 border-opacity-50">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-dumbbell text-green-600 mr-2"></i>
                            Trainers Directory
                        </h3>
                        <span class="text-sm text-gray-500">{{ $allTrainers->count() }} trainers</span>
                    </div>
                    <!-- Search and Sort -->
                    <div class="flex gap-2">
                        <div class="relative flex-1">
                            <input type="text" 
                                id="searchTrainers" 
                                placeholder="Search trainers..." 
                                class="w-full px-3 py-2 pl-9 text-sm glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                        </div>
                        <select id="sortTrainers" class="px-3 py-2 text-sm glass-card rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                            <option value="name">All Trainers</option>
                        </select>
                    </div>
                </div>
                <div class="divide-y divide-gray-200 divide-opacity-30 max-h-96 overflow-y-auto" id="trainersListContainer">

<?php
/*
STEP 3: Add this JavaScript before the closing </script> tag (around line 489):
*/
?>
<script>
    // Members Directory Search and Filter
    const searchMembers = document.getElementById('searchMembers');
    const sortMembers = document.getElementById('sortMembers');
    const membersContainer = document.getElementById('membersListContainer');
    const allMemberItems = Array.from(membersContainer.children);

    function filterMembers() {
        const searchTerm = searchMembers.value.toLowerCase();
        const filterType = sortMembers.value;

        allMemberItems.forEach(item => {
            const name = item.querySelector('.text-sm.font-semibold')?.textContent.toLowerCase() || '';
            const email = item.querySelector('.text-xs.text-gray-500')?.textContent.toLowerCase() || '';
            const membershipBadge = item.querySelector('.bg-gradient-to-r')?.textContent.toLowerCase() || '';
            
            const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
            const matchesFilter = filterType === 'name' || membershipBadge.includes(filterType);

            if (matchesSearch && matchesFilter) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }

    searchMembers?.addEventListener('input', filterMembers);
    sortMembers?.addEventListener('change', filterMembers);

    // Trainers Directory Search
    const searchTrainers = document.getElementById('searchTrainers');
    const trainersContainer = document.getElementById('trainersListContainer');
    const allTrainerItems = Array.from(trainersContainer.children);

    function filterTrainers() {
        const searchTerm = searchTrainers.value.toLowerCase();

        allTrainerItems.forEach(item => {
            const name = item.querySelector('.text-sm.font-semibold')?.textContent.toLowerCase() || '';
            const specialization = item.querySelector('.text-xs.text-gray-500')?.textContent.toLowerCase() || '';
            
            const matchesSearch = name.includes(searchTerm) || specialization.includes(searchTerm);

            if (matchesSearch) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }

    searchTrainers?.addEventListener('input', filterTrainers);
</script>
