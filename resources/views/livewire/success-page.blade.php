<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="max-w-4xl mx-auto">
        <!-- Success Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-6 dark:bg-green-900/30">
                <svg class="w-10 h-10 text-green-600 dark:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                Order Placed Successfully!
            </h1>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">
                Thank you for your purchase. Your order has been received and is being processed.
            </p>
        </div>

        <!-- Order Overview Card -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800 mb-8">
            <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-y md:divide-y-0 divide-gray-200 dark:divide-slate-800">
                <div class="p-6 text-center md:text-left">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1 dark:text-gray-400">Order Number</p>
                    <p class="text-lg font-bold text-gray-900 dark:text-white hover:text-blue-600 transition-colors">{{ $order->order_number }}</p>
                </div>
                <div class="p-6 text-center md:text-left">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1 dark:text-gray-400">Date</p>
                    <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $order->created_at->format('M d, Y') }}</p>
                </div>
                <div class="p-6 text-center md:text-left">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1 dark:text-gray-400">Total Amount</p>
                    <p class="text-lg font-bold text-blue-600 dark:text-blue-400">{{ moneyFormat($order->grand_total) }}</p>
                </div>
                <div class="p-6 text-center md:text-left">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1 dark:text-gray-400">Payment Method</p>
                    <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $order->payment_method->getLabel() }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Items -->
            <div class="lg:col-span-2 space-y-4">
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm dark:bg-slate-900 dark:border-slate-800 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-800/50">
                        <h2 class="text-lg font-bold text-gray-800 dark:text-white">Ordered Items</h2>
                    </div>
                    <ul class="divide-y divide-gray-200 dark:divide-slate-800">
                        @foreach($order->items as $item)
                        <li class="p-6 flex items-center gap-4">
                            <div class="w-16 h-16 bg-gray-100 rounded-lg flex-shrink-0 overflow-hidden dark:bg-slate-800">
                                <img src="{{ $item->product->image_urls[0] }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ $item->product->name }}</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Quantity: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-900 dark:text-white">{{ moneyFormat($item->total_amount) }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ moneyFormat($item->unit_amount) }} each</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <div class="p-6 bg-gray-50 dark:bg-slate-800/30 border-t border-gray-200 dark:border-slate-800 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                            <span class="font-bold text-gray-900 dark:text-white">{{ moneyFormat($order->grand_total - $order->shipping_amount) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                            <span class="font-bold text-gray-900 dark:text-white">{{ moneyFormat($order->shipping_amount) }}</span>
                        </div>
                        <div class="flex justify-between text-lg pt-3 border-t border-gray-200 dark:border-slate-800">
                            <span class="font-black text-gray-900 dark:text-white uppercase tracking-wider">Total</span>
                            <span class="font-black text-blue-600 dark:text-blue-400">{{ moneyFormat($order->grand_total) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping & Address -->
            <div class="space-y-6">
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm dark:bg-slate-900 dark:border-slate-800 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-800/50">
                        <h2 class="text-lg font-bold text-gray-800 dark:text-white text-center">Shipping Information</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase mb-2">Recipient</p>
                            <p class="text-sm font-bold text-gray-800 dark:text-white">{{ $order->address->first_name }} {{ $order->address->last_name }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->address->phone }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase mb-2">Detailed Address</p>
                            <p class="text-sm text-gray-800 dark:text-gray-300 leading-relaxed italic">
                                {{ $order->address->street_address }},
                                {{ $order->address->area }},
                                {{ $order->address->district }},
                                {{ $order->address->division }} - {{ $order->address->zip_code }}
                            </p>
                        </div>
                        <div class="pt-4 border-t border-gray-100 dark:border-slate-800 flex items-center gap-3">
                            <div class="p-2 bg-blue-50 rounded-lg dark:bg-blue-900/20 text-blue-600 dark:text-blue-400">
                                <svg class="w-5 h-5 font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase italic">Delivery Status</p>
                                <p class="text-sm font-bold text-green-600 dark:text-green-400">{{ $order->status->getLabel() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-3">
                    <a href="/products" class="flex items-center justify-center w-full px-6 py-3.5 bg-gray-900 text-white font-black rounded-xl hover:bg-black transition-all transform hover:-translate-y-1 dark:bg-slate-700 dark:hover:bg-slate-600">
                        Continue Shopping
                    </a>
                    <a href="/my-orders" class="flex items-center justify-center w-full px-6 py-3.5 bg-white text-gray-900 border border-gray-200 font-black rounded-xl hover:bg-gray-50 transition-all dark:bg-slate-800 dark:text-white dark:border-slate-700 dark:hover:bg-slate-700/50">
                        My Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
