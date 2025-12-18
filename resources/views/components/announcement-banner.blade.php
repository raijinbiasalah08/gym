@if($announcements->isNotEmpty())
    <div class="mb-6 space-y-4">
        @foreach($announcements as $announcement)
            <div class="rounded-md p-4 
                @if($announcement->type == 'info') bg-blue-50 border-l-4 border-blue-400
                @elseif($announcement->type == 'warning') bg-yellow-50 border-l-4 border-yellow-400
                @elseif($announcement->type == 'danger') bg-red-50 border-l-4 border-red-400
                @elseif($announcement->type == 'success') bg-green-50 border-l-4 border-green-400
                @endif">
                <div class="flex">
                    <div class="flex-shrink-0">
                        @if($announcement->type == 'info')
                            <i class="fas fa-info-circle text-blue-400"></i>
                        @elseif($announcement->type == 'warning')
                            <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                        @elseif($announcement->type == 'danger')
                            <i class="fas fa-exclamation-circle text-red-400"></i>
                        @elseif($announcement->type == 'success')
                            <i class="fas fa-check-circle text-green-400"></i>
                        @endif
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium
                            @if($announcement->type == 'info') text-blue-800
                            @elseif($announcement->type == 'warning') text-yellow-800
                            @elseif($announcement->type == 'danger') text-red-800
                            @elseif($announcement->type == 'success') text-green-800
                            @endif">
                            {{ $announcement->title }}
                        </h3>
                        <div class="mt-2 text-sm
                            @if($announcement->type == 'info') text-blue-700
                            @elseif($announcement->type == 'warning') text-yellow-700
                            @elseif($announcement->type == 'danger') text-red-700
                            @elseif($announcement->type == 'success') text-green-700
                            @endif">
                            <p>{{ $announcement->message }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
