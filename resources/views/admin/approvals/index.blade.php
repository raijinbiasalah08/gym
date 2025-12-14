@extends('layouts.app')

@section('title', 'User Approvals - GymSystem')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">User Approvals</h1>
                <p class="text-sm text-gray-600 mt-1">Manage pending user registrations</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" 
               class="px-4 py-2 glass-card text-gray-700 font-medium rounded-lg hover:bg-white hover:bg-opacity-60 transition">
                <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center shadow-sm">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabs -->
        <div class="mb-6">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <button onclick="showTab('pending')" id="pending-tab" class="tab-button border-orange-500 text-orange-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Pending ({{ $pendingUsers->count() }})
                    </button>
                    <button onclick="showTab('approved')" id="approved-tab" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Approved ({{ $approvedUsers->count() }})
                    </button>
                    <button onclick="showTab('rejected')" id="rejected-tab" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Rejected ({{ $rejectedUsers->count() }})
                    </button>
                </nav>
            </div>
        </div>

        <!-- Pending Users -->
        <div id="pending-content" class="tab-content">
            @if($pendingUsers->count() > 0)
                <div class="grid grid-cols-1 gap-4">
                    @foreach($pendingUsers as $user)
                        <div class="glass-card rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-orange-400 to-red-600 flex items-center justify-center shadow-md">
                                        <span class="text-white font-bold text-xl">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                        <div class="flex items-center space-x-3 mt-1">
                                            <span class="bg-gradient-to-r from-{{ $user->role === 'trainer' ? 'green' : 'orange' }}-500 to-{{ $user->role === 'trainer' ? 'green' : 'red' }}-600 text-white text-xs px-2 py-1 rounded-full font-medium">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                <i class="fas fa-clock mr-1"></i>{{ $user->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @if($user->role === 'trainer')
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-3">
                                        <i class="fas fa-file-alt mr-2 text-orange-500"></i>Verification Documents
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Valid ID -->
                                        @if($user->valid_id_path)
                                            <div class="bg-gray-50 rounded-lg p-3">
                                                <p class="text-xs font-medium text-gray-600 mb-2">Valid ID</p>
                                                @if(str_ends_with($user->valid_id_path, '.pdf'))
                                                    <a href="{{ asset('storage/' . $user->valid_id_path) }}" target="_blank" 
                                                       class="flex items-center text-sm text-orange-600 hover:text-orange-700">
                                                        <i class="fas fa-file-pdf text-2xl mr-2"></i>
                                                        <span>View PDF</span>
                                                    </a>
                                                @else
                                                    <a href="{{ asset('storage/' . $user->valid_id_path) }}" target="_blank">
                                                        <img src="{{ asset('storage/' . $user->valid_id_path) }}" 
                                                             alt="Valid ID" 
                                                             class="w-full h-32 object-cover rounded border border-gray-300 hover:opacity-75 transition">
                                                    </a>
                                                @endif
                                            </div>
                                        @endif
                                        
                                        <!-- Certifications -->
                                        @if($user->certifications)
                                            @php
                                                $certs = json_decode($user->certifications, true) ?? [];
                                            @endphp
                                            @if(count($certs) > 0)
                                                <div class="bg-gray-50 rounded-lg p-3">
                                                    <p class="text-xs font-medium text-gray-600 mb-2">Certifications ({{ count($certs) }})</p>
                                                    <div class="space-y-2">
                                                        @foreach($certs as $index => $cert)
                                                            @if(str_ends_with($cert, '.pdf'))
                                                                <a href="{{ asset('storage/' . $cert) }}" target="_blank" 
                                                                   class="flex items-center text-sm text-orange-600 hover:text-orange-700">
                                                                    <i class="fas fa-file-pdf mr-2"></i>
                                                                    <span>Certificate {{ $index + 1 }}</span>
                                                                </a>
                                                            @else
                                                                <a href="{{ asset('storage/' . $cert) }}" target="_blank">
                                                                    <img src="{{ asset('storage/' . $cert) }}" 
                                                                         alt="Certificate {{ $index + 1 }}" 
                                                                         class="w-full h-24 object-cover rounded border border-gray-300 hover:opacity-75 transition">
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endif
                            
                            <div class="mt-4 flex justify-end space-x-2">
                                    <form action="{{ route('admin.approvals.approve', $user) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white font-medium rounded-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                            <i class="fas fa-check mr-1"></i>Approve
                                        </button>
                                    </form>
                                    <button onclick="openRejectModal({{ $user->id }}, '{{ $user->name }}')" class="px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white font-medium rounded-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                        <i class="fas fa-times mr-1"></i>Reject
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 glass-card rounded-xl">
                    <i class="fas fa-check-circle text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">No Pending Approvals</h3>
                    <p class="text-gray-500">All registrations have been processed</p>
                </div>
            @endif
        </div>

        <!-- Approved Users -->
        <div id="approved-content" class="tab-content hidden">
            @if($approvedUsers->count() > 0)
                <div class="glass-card rounded-xl overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 bg-opacity-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Approved At</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Approved By</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($approvedUsers as $user)
                                <tr class="hover:bg-white hover:bg-opacity-30 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center shadow-md">
                                                <span class="text-white font-bold">{{ substr($user->name, 0, 1) }}</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->approved_at ? \Carbon\Carbon::parse($user->approved_at)->format('M d, Y H:i') : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->approvedBy->name ?? 'System' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-16 glass-card rounded-xl">
                    <i class="fas fa-user-check text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">No Approved Users</h3>
                    <p class="text-gray-500">No users have been approved yet</p>
                </div>
            @endif
        </div>

        <!-- Rejected Users -->
        <div id="rejected-content" class="tab-content hidden">
            @if($rejectedUsers->count() > 0)
                <div class="grid grid-cols-1 gap-4">
                    @foreach($rejectedUsers as $user)
                        <div class="glass-card rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center shadow-md">
                                        <span class="text-white font-bold text-xl">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                        @if($user->rejection_reason)
                                            <p class="text-sm text-red-600 mt-1">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $user->rejection_reason }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">
                                    Rejected {{ $user->updated_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 glass-card rounded-xl">
                    <i class="fas fa-user-times text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">No Rejected Users</h3>
                    <p class="text-gray-500">No registrations have been rejected</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl p-6 max-w-md w-full">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Reject Registration</h3>
        <p class="text-sm text-gray-600 mb-4">Are you sure you want to reject <span id="rejectUserName" class="font-semibold"></span>?</p>
        
        <form id="rejectForm" method="POST">
            @csrf
            <div class="mb-4">
                <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">Reason for Rejection *</label>
                <textarea id="rejection_reason" name="rejection_reason" rows="3" required
                          class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 text-gray-900"
                          placeholder="Please provide a reason..."></textarea>
            </div>
            
            <div class="flex space-x-3">
                <button type="button" onclick="closeRejectModal()" 
                        class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button type="submit" 
                        class="flex-1 px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white font-medium rounded-lg hover:shadow-xl transition">
                    Reject
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showTab(tab) {
    // Hide all content
    document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));
    
    // Remove active state from all tabs
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('border-orange-500', 'text-orange-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected content
    document.getElementById(tab + '-content').classList.remove('hidden');
    
    // Activate selected tab
    const activeTab = document.getElementById(tab + '-tab');
    activeTab.classList.remove('border-transparent', 'text-gray-500');
    activeTab.classList.add('border-orange-500', 'text-orange-600');
}

function openRejectModal(userId, userName) {
    document.getElementById('rejectUserName').textContent = userName;
    document.getElementById('rejectForm').action = `/admin/user-approvals/${userId}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.getElementById('rejection_reason').value = '';
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeRejectModal();
    }
});
</script>
@endsection
