<div class="w-full max-w-[50rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="bg-white rounded-2xl shadow-xl dark:bg-slate-900 overflow-hidden border border-gray-100 dark:border-slate-800">
        <!-- Header -->
        <div class="bg-gradient-to-r from-pink-500 to-rose-600 p-6 sm:p-10 text-center">
            <div class="mb-4 flex justify-center">
                <div class="bg-white p-3 rounded-full shadow-lg">
                    <img src="{{ asset('images/payment-method/bkash-logo.png') }}" alt="bKash" class="h-10" onerror="this.src='https://upload.wikimedia.org/wikipedia/en/thumb/8/8b/Bkash_logo.otf/1200px-Bkash_logo.otf.png'">
                </div>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white">
                bKash Payment
            </h1>
            <p class="text-rose-100 mt-2">
                Order #{{ $order->id }} - Total: {{ moneyFormat($order->grand_total) }}
            </p>
        </div>

        <div class="p-6 sm:p-10">
            <div class="space-y-6">
                <!-- Instructions -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 dark:bg-blue-900/30 dark:border-blue-600 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-bold text-blue-800 dark:text-blue-300">How to pay?</h3>
                            <div class="mt-1 text-sm text-blue-700 dark:text-blue-400 space-y-1">
                                <p>1. Go to your bKash app or dial *247#</p>
                                <p>2. Choose "Send Money" or "Payment"</p>
                                <p>3. Enter Number: <span class="font-bold text-lg select-all">{{ $bkash_number }}</span> (Personal)</p>
                                <p>4. Enter Amount: <span class="font-bold text-lg">{{ moneyFormat($order->grand_total) }}</span></p>
                                <p>5. Enter Reference Number: <span class="font-bold text-lg select-all">{{ $order->id }}</span></p>
                                <p>6. After successful payment, enter your number and Transaction ID below.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <form wire:submit.prevent="completePayment" class="space-y-4">
                    <div>
                        <label for="payment_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">bKash Number (From which you sent) <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                            </div>
                            <input wire:model="payment_phone" type="phone" id="payment_phone" class="block w-full pl-10 pr-3 py-3 border @error('payment_phone') border-red-500 @else border-gray-300 dark:border-slate-700 @enderror rounded-xl leading-5 bg-white dark:bg-slate-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 sm:text-sm transition-all duration-200" placeholder="01XXXXXXXXX">
                        </div>
                        @error('payment_phone') <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="payment_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Amount <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">৳</span>
                            </div>
                            <input wire:model="payment_amount" type="number" id="payment_amount" class="block w-full pl-10 pr-3 py-3 border @error('payment_amount') border-red-500 @else border-gray-300 dark:border-slate-700 @enderror rounded-xl leading-5 bg-white dark:bg-slate-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 sm:text-sm transition-all duration-200" placeholder="{{ $order->grand_total }}">
                        </div>
                        @error('payment_amount') <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="transaction_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Transaction ID <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input wire:model="transaction_id" type="text" id="transaction_id" class="block w-full pl-10 pr-3 py-3 border @error('transaction_id') border-red-500 @else border-gray-300 dark:border-slate-700 @enderror rounded-xl leading-5 bg-white dark:bg-slate-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 sm:text-sm transition-all duration-200" placeholder="e.g. 8N7A6D5C">
                        </div>
                        @error('transaction_id') <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-4 flex flex-col sm:flex-row gap-4">
                        <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-pink-200 dark:shadow-none transform transition hover:-translate-y-1 active:scale-95 duration-200 flex items-center justify-center">
                            <span>Complete Order</span>
                            <svg class="ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <a href="{{ route('cancel') }}" class="w-full sm:w-auto text-center py-3 px-6 text-gray-600 dark:text-gray-400 font-medium hover:text-gray-900 dark:hover:text-white transition-colors duration-200">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="bg-gray-50 dark:bg-slate-800/50 p-4 text-center border-t border-gray-100 dark:border-slate-800">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Secure payment powered by bKash. Nafisa Mart does not store your bKash PIN.
            </p>
        </div>
    </div>
</div>
