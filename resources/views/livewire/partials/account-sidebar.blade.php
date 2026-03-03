<div class="col-span-12 lg:col-span-4">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 dark:bg-slate-900 dark:border-gray-700 overflow-hidden">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white">My Account</h2>
        </div>
        <nav class="flex flex-col">
            <a wire:navigate href="{{ route('profile') }}" class="flex items-center gap-x-3.5 py-3 px-4 text-sm font-medium {{ request()->routeIs('profile') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-500' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-slate-800' }}">
                <div class="flex items-center justify-center w-10 h-10 rounded-lg {{ request()->routeIs('profile') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-500 dark:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                Account Information
            </a>
            <a wire:navigate href="{{ route('my-orders') }}" class="flex items-center gap-x-3.5 py-3 px-4 text-sm font-medium {{ request()->is('my-orders*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-500' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-slate-800' }}">
                <div class="flex items-center justify-center w-10 h-10 rounded-lg {{ request()->is('my-orders*') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-500 dark:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                My Orders
            </a>
            <!-- Additional placeholder items to match screenshot profile -->
            <a href="#" class="flex items-center gap-x-3.5 py-3 px-4 text-sm font-medium text-gray-500 cursor-not-allowed opacity-60">
                 <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-50 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
                My Product Reviews
            </a>

            {{-- manage address --}}
            <a href="#" class="flex items-center gap-x-3.5 py-3 px-4 text-sm font-medium text-gray-500 cursor-not-allowed opacity-60">
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-50 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                Manage Address
            </a>

            {{-- logout --}}
            <a href="{{ route('logout') }}" class="flex items-center gap-x-3.5 py-3 px-4 text-sm font-medium text-gray-500 cursor-pointer">
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-50 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-2m14-2V4a2 2 0 00-2-2h-5.586a1 1 0 01-.707-.293l-2.493 2.493a1 1 0 01-1.011 0l-2.493-2.493A2 2 0 005 4v2a2 2 0 00-2 2H3a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2h-1m-1 16H5a1 1 0 01-1-1v-1a1 1 0 011-1h12a1 1 0 011 1v1a1 1 0 01-1 1z" />
                    </svg>
                </div>
                Logout
            </a>
        </nav>
    </div>
</div>
