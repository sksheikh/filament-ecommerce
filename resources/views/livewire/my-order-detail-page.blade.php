<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="grid grid-cols-12 gap-6">
        <!-- Sidebar -->
        @include('livewire.partials.account-sidebar')

        <!-- Main Content -->
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 dark:bg-slate-900 dark:border-gray-700 overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">Order Details</h2>
                </div>

                <div class="p-6">
                    <!-- Order Info Grid -->
                    <div class="grid sm:grid-cols-2 gap-4 mb-8">
                        <div class="p-4 bg-gray-50 rounded-xl dark:bg-slate-800/50 border border-gray-100 dark:border-gray-700">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400 font-bold mb-2">Customer</p>
                            <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $order->address?->full_name }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $order->address?->phone }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-xl dark:bg-slate-800/50 border border-gray-100 dark:border-gray-700">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400 font-bold mb-2">Order Info</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Date: <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $order->created_at->format('d-m-Y') }}</span></p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Status: 
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $order->status->getColor() == 'success' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $order->status->getLabel() }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- Products Table -->
                    <div class="mb-8 overflow-hidden border border-gray-100 rounded-xl dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-slate-800">
                                <tr>
                                    <th class="px-6 py-3 text-start text-xs font-semibold text-gray-500 uppercase">Product</th>
                                    <th class="px-6 py-3 text-start text-xs font-semibold text-gray-500 uppercase">Price</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Qty</th>
                                    <th class="px-6 py-3 text-end text-xs font-semibold text-gray-500 uppercase">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($order_items as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-x-3">
                                                <img class="size-10 rounded-lg object-cover" src="{{ $item->product->image_urls[0] }}" alt="{{ $item->product->name }}">
                                                <span class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $item->product->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">{{ moneyFormat($item->unit_amount) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-600 dark:text-gray-400">{{ $item->quantity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-end font-semibold text-gray-800 dark:text-gray-200">{{ moneyFormat($item->total_amount) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Address and Summary -->
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-bold text-gray-800 dark:text-white uppercase mb-4">Shipping Address</h4>
                            <div class="p-4 bg-gray-50 rounded-xl dark:bg-slate-800/50 border border-gray-100 dark:border-gray-700">
                                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed italic">
                                    {{ $order->address?->street_address }}<br>
                                    {{ $order->address?->area }}, {{ $order->address?->district }}<br>
                                    {{ $order->address?->division }} - {{ $order->address?->zip_code }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-800 dark:text-white uppercase mb-4">Order Summary</h4>
                            <div class="p-4 bg-gray-50 rounded-xl dark:bg-slate-800/50 border border-gray-100 dark:border-gray-700 space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                                    <span class="font-medium text-gray-800 dark:text-gray-200">{{ moneyFormat($order->grand_total - $order->shipping_amount) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                                    <span class="font-medium text-gray-800 dark:text-gray-200">{{ moneyFormat($order->shipping_amount) }}</span>
                                </div>
                                <div class="pt-3 border-t border-gray-200 dark:border-gray-700 flex justify-between">
                                    <span class="text-base font-bold text-gray-800 dark:text-white">Grand Total</span>
                                    <span class="text-base font-bold text-blue-600 dark:text-blue-500">{{ moneyFormat($order->grand_total) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
