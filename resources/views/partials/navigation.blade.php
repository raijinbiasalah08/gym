<nav class="bg-blue-600 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="text-white text-xl font-bold">
                        <i class="fas fa-dumbbell mr-2"></i>GymSystem
                    </a>
                </div>
                
                @auth
                <div class="hidden md:ml-6 md:flex md:space-x-4">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" 
                           class="{{ request()->routeIs('admin.*') ? 'bg-blue-700' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.members.index') }}" 
                           class="{{ request()->routeIs('admin.members.*') ? 'bg-blue-700' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
                            Members
                        </a>
                        <a href="{{ route('admin.trainers.index') }}" 
                           class="{{ request()->routeIs('admin.trainers.*') ? 'bg-blue-700' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
                            Trainers
                        </a>
                        <a href="{{ route('admin.payments.index') }}" 
                           class="{{ request()->routeIs('admin.payments.*') ? 'bg-blue-700' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
                            Payments
                        </a>
                    @elseif(auth()->user()->isTrainer())
                        <a href="{{ route('trainer.dashboard') }}" 
                           class="{{ request()->routeIs('trainer.dashboard') ? 'bg-blue-700' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
                            Dashboard
                        </a>
                        <a href="{{ route('trainer.workout-plans.index') }}" 
                           class="{{ request()->routeIs('trainer.workout-plans.*') ? 'bg-blue-700' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
                            Workout Plans
                        </a>
                        <a href="{{ route('trainer.attendance.index') }}" 
                           class="{{ request()->routeIs('trainer.attendance.*') ? 'bg-blue-700' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
                            Attendance
                        </a>
                    @elseif(auth()->user()->isMember())
                        <a href="{{ route('member.dashboard') }}" 
                           class="{{ request()->routeIs('member.dashboard') ? 'bg-blue-700' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
                            Dashboard
                        </a>
                        <a href="{{ route('member.bookings.index') }}" 
                           class="{{ request()->routeIs('member.bookings.*') ? 'bg-blue-700' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
                            Bookings
                        </a>
                        <a href="{{ route('member.progress.index') }}" 
                           class="{{ request()->routeIs('member.progress.*') ? 'bg-blue-700' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
                            Progress
                        </a>
                    @endif
                </div>
                @endauth
            </div>

            <div class="flex items-center">
                @auth
                    <div class="flex items-center space-x-4">
                        <span class="text-white text-sm">
                            Welcome, {{ auth()->user()->name }}
                        </span>
                        <span class="bg-blue-500 text-white px-2 py-1 rounded-full text-xs">
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-white hover:text-gray-200 text-sm">
                                <i class="fas fa-sign-out-alt mr-1"></i>Logout
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex space-x-2">
                        <a href="{{ route('login') }}" class="text-white hover:text-gray-200 px-3 py-2 text-sm">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-500 text-white hover:bg-blue-400 px-3 py-2 rounded text-sm">
                            Register
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>