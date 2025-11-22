<nav class="bg-blue-600 bg-opacity-90 backdrop-filter backdrop-blur-lg shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="text-white text-xl font-bold flex items-center">
                        <i class="fas fa-dumbbell mr-2"></i>
                        <span>TitansGym</span>
                    </a>
                </div>
                
                <!-- Desktop links -->
                @auth
                <div class="hidden md:ml-6 md:flex md:space-x-4">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" 
                           class="{{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
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
                        <a href="{{ route('admin.reports.index') }}" 
                           class="{{ request()->routeIs('admin.reports.*') ? 'bg-blue-700' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
                            Reports
                        </a>
                    @elseif(auth()->user()->isTrainer())
                        <a href="{{ route('trainer.dashboard') }}" 
                           class="{{ request()->routeIs('trainer.dashboard') ? 'bg-blue-700' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
                            Dashboard
                        </a>
                        <a href="{{ route('trainer.bookings.index') }}" 
                           class="{{ request()->routeIs('trainer.bookings.*') ? 'bg-blue-700' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
                            My Bookings
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
                        <a href="{{ route('member.payments.index') }}" 
                           class="{{ request()->routeIs('member.payments.*') ? 'bg-blue-700' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
                            Payments
                        </a>
                        <a href="{{ route('member.membership') }}" 
                           class="{{ request()->routeIs('member.membership') ? 'bg-blue-700' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
                            Membership
                        </a>
                    @endif
                </div>
                @endauth
            </div>

            <div class="flex items-center">
                @auth
                    <div class="hidden sm:flex items-center space-x-4">
                        <span class="text-white text-sm">Welcome, {{ auth()->user()->name }}</span>
                        <span class="bg-blue-500 text-white px-2 py-1 rounded-full text-xs">{{ ucfirst(auth()->user()->role) }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-white hover:text-gray-200 text-sm">
                                <i class="fas fa-sign-out-alt mr-1"></i>Logout
                            </button>
                        </form>
                    </div>
                @else
                    <div class="hidden sm:flex space-x-2">
                        <a href="{{ route('login') }}" class="text-white hover:text-gray-200 px-3 py-2 text-sm">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-500 text-white hover:bg-blue-400 px-3 py-2 rounded text-sm">Register</a>
                    </div>
                @endauth

                <!-- Mobile menu button -->
                <div class="-mr-2 flex md:hidden">
                    <button type="button" aria-controls="mobile-menu" aria-expanded="false" onclick="toggleMobileMenu()"
                            class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-200 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-600 focus:ring-white">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-blue-600">
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block text-white px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
                    <a href="{{ route('admin.members.index') }}" class="block text-white px-3 py-2 rounded-md text-base font-medium">Members</a>
                    <a href="{{ route('admin.trainers.index') }}" class="block text-white px-3 py-2 rounded-md text-base font-medium">Trainers</a>
                    <a href="{{ route('admin.payments.index') }}" class="block text-white px-3 py-2 rounded-md text-base font-medium">Payments</a>
                    <a href="{{ route('admin.reports.index') }}" class="block text-white px-3 py-2 rounded-md text-base font-medium">Reports</a>
                @elseif(auth()->user()->isTrainer())
                    <a href="{{ route('trainer.dashboard') }}" class="block text-white px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
                    <a href="{{ route('trainer.bookings.index') }}" class="block text-white px-3 py-2 rounded-md text-base font-medium">My Bookings</a>
                    <a href="{{ route('trainer.workout-plans.index') }}" class="block text-white px-3 py-2 rounded-md text-base font-medium">Workout Plans</a>
                    <a href="{{ route('trainer.attendance.index') }}" class="block text-white px-3 py-2 rounded-md text-base font-medium">Attendance</a>
                @elseif(auth()->user()->isMember())
                    <a href="{{ route('member.dashboard') }}" class="block text-white px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
                    <a href="{{ route('member.bookings.index') }}" class="block text-white px-3 py-2 rounded-md text-base font-medium">Bookings</a>
                    <a href="{{ route('member.progress.index') }}" class="block text-white px-3 py-2 rounded-md text-base font-medium">Progress</a>
                    <a href="{{ route('member.payments.index') }}" class="block text-white px-3 py-2 rounded-md text-base font-medium">Payments</a>
                    <a href="{{ route('member.membership') }}" class="block text-white px-3 py-2 rounded-md text-base font-medium">Membership</a>
                @endif

                <div class="border-t border-blue-500 mt-2 pt-2">
                    <div class="px-3 text-white text-sm">Welcome, {{ auth()->user()->name }}</div>
                    <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
                        @csrf
                        <button type="submit" class="w-full text-left text-white">Logout</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="block text-white px-3 py-2 rounded-md text-base font-medium">Login</a>
                <a href="{{ route('register') }}" class="block bg-blue-500 text-white px-3 py-2 rounded-md text-base font-medium">Register</a>
            @endauth
        </div>
    </div>

    <script>
        function toggleMobileMenu(){
            var el = document.getElementById('mobile-menu');
            if(!el) return;
            el.classList.toggle('hidden');
        }
    </script>
</nav>