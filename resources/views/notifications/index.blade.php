@extends('layouts.app')

@section('title', 'Notifications - GymManagement')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Your Notifications</h2>
            
            @if($notifications->count() > 0)
                <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-orange-600 hover:text-orange-800 font-semibold transition">
                        Mark all as read
                    </button>
                </form>
            @endif
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @forelse($notifications as $notification)
                    <div class="flex items-start p-4 hover:bg-gray-50 transition border-b border-gray-100 last:border-0 {{ is_null($notification->read_at) ? 'bg-orange-50' : '' }}">
                        <div class="flex-shrink-0 mr-4">
                            @php
                                $color = $notification->data['color'] ?? 'blue';
                                $icon = $notification->data['icon'] ?? 'fas fa-bell';
                                
                                $colorClasses = [
                                    'blue' => 'bg-blue-100 text-blue-600',
                                    'green' => 'bg-green-100 text-green-600',
                                    'orange' => 'bg-orange-100 text-orange-600',
                                    'red' => 'bg-red-100 text-red-600',
                                    'yellow' => 'bg-yellow-100 text-yellow-600',
                                    'purple' => 'bg-purple-100 text-purple-600',
                                ];
                                
                                $class = $colorClasses[$color] ?? $colorClasses['blue'];
                            @endphp
                            
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $class }}">
                                <i class="{{ $icon }}"></i>
                            </div>
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h3 class="text-sm font-semibold text-gray-900 {{ !$notification->is_read ? 'font-bold' : '' }}">
                                    {{ $notification->title ?? 'Notification' }}
                                </h3>
                                <span class="text-xs text-gray-500 whitespace-nowrap ml-2">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                            </div>
                            
                            <p class="mt-1 text-sm text-gray-600">
                                {{ $notification->message ?? '' }}
                            </p>
                            
                            @if($notification->link)
                                <a href="{{ $notification->link }}" class="mt-2 inline-block text-xs font-medium text-orange-600 hover:text-orange-500">
                                    View Details <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            @endif
                        </div>
                        
                        @if(!$notification->is_read)
                            <div class="ml-4 flex-shrink-0">
                                <form action="{{ route('notifications.mark-as-read', $notification->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-gray-400 hover:text-orange-600" title="Mark as read">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="ml-4 flex-shrink-0 text-gray-300">
                                <i class="fas fa-check-double" title="Read"></i>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                            <i class="fas fa-bell-slash text-gray-400 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">No notifications</h3>
                        <p class="mt-1 text-gray-500">You're all caught up! Check back later for updates.</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            @if($notifications->hasPages())
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
