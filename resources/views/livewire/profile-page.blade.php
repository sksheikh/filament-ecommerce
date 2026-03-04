<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="grid grid-cols-12 gap-6">
        <!-- Sidebar -->
        @include('livewire.partials.account-sidebar')

        <!-- Main Content -->
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 dark:bg-slate-900 dark:border-gray-700">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">Account Information</h2>
                    @if(!$is_editing)
                    <button wire:click="toggleEdit" class="py-2 px-6 inline-flex justify-center items-center gap-2 rounded-lg border font-medium bg-white text-blue-600 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-blue-500 dark:focus:ring-offset-gray-800">
                        Edit
                    </button>
                    @endif
                </div>

                <div class="p-6">
                    @if($is_editing)
                        <form wire:submit.prevent="updateProfile" class="space-y-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">First Name</label>
                                    <input wire:model="first_name" type="text" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                    @error('first_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Last Name</label>
                                    <input wire:model="last_name" type="text" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                    @error('last_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Contact Number</label>
                                    <input wire:model="phone" type="text" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                    @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date of Birth</label>
                                    <input wire:model="date_of_birth" type="date" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                    @error('date_of_birth') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Gender</label>
                                <select wire:model="gender" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('gender') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex gap-x-3 justify-end">
                                <button type="button" wire:click="toggleEdit" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 transition-all">
                                    Cancel
                                </button>
                                <button type="submit" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 transition-all">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="space-y-8">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">First Name</h4>
                                    <p class="text-gray-800 dark:text-white font-semibold">{{ $first_name ?: '---' }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Last Name</h4>
                                    <p class="text-gray-800 dark:text-white font-semibold">{{ $last_name ?: '---' }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Contact Number</h4>
                                    <p class="text-gray-800 dark:text-white font-semibold">{{ $phone ?: '---' }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Date of Birth</h4>
                                    <p class="text-gray-800 dark:text-white font-semibold">{{ $date_of_birth ?: '---' }}</p>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Gender</h4>
                                <p class="text-gray-800 dark:text-white font-semibold capitalize">{{ $gender ?: '---' }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="p-6 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-slate-800/50">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-6">Account Security</h3>

                    {{-- Change Email Section --}}
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-3">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-800 dark:text-white">Email Address</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $current_email }}</p>
                            </div>
                            @if(!$is_changing_email)
                            <button wire:click="toggleChangeEmail" class="py-2 px-5 inline-flex justify-center items-center gap-2 rounded-lg border font-medium bg-white text-blue-600 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-blue-500 dark:focus:ring-offset-gray-800">
                                Change Email
                            </button>
                            @endif
                        </div>

                        @if($is_changing_email)
                            <form wire:submit.prevent="changeEmail" class="space-y-4 mt-4 p-4 bg-white dark:bg-slate-900 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">New Email Address</label>
                                        <input wire:model="new_email" type="email" placeholder="Enter new email" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                        @error('new_email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm Password</label>
                                        <input wire:model="email_password" type="password" placeholder="Enter your password" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                        @error('email_password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="flex gap-x-3 justify-end pt-2">
                                    <button type="button" wire:click="toggleChangeEmail" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 transition-all">
                                        Cancel
                                    </button>
                                    <button type="submit" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 transition-all">
                                        Update Email
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>

                    {{-- Divider --}}
                    <hr class="border-gray-200 dark:border-gray-700 mb-6">

                    {{-- Change Password Section --}}
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-800 dark:text-white">Password</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Update your account password.</p>
                            </div>
                            @if(!$is_changing_password)
                            <button wire:click="toggleChangePassword" class="py-2 px-5 inline-flex justify-center items-center gap-2 rounded-lg border font-medium bg-white text-blue-600 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-blue-500 dark:focus:ring-offset-gray-800">
                                Change Password
                            </button>
                            @endif
                        </div>

                        @if($is_changing_password)
                            <form wire:submit.prevent="changePassword" class="space-y-4 mt-4 p-4 bg-white dark:bg-slate-900 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Current Password</label>
                                    <input wire:model="current_password" type="password" placeholder="Enter current password" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                    @error('current_password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">New Password</label>
                                        <input wire:model="new_password" type="password" placeholder="Enter new password" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                        @error('new_password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm New Password</label>
                                        <input wire:model="new_password_confirmation" type="password" placeholder="Confirm new password" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                                    </div>
                                </div>

                                <div class="flex gap-x-3 justify-end pt-2">
                                    <button type="button" wire:click="toggleChangePassword" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 transition-all">
                                        Cancel
                                    </button>
                                    <button type="submit" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 transition-all">
                                        Update Password
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
