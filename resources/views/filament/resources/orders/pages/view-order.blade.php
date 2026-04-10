<x-filament::page>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Order Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Items -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
                <div class="p-4 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/30">
                    <h3 class="font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <x-heroicon-o-shopping-cart class="w-5 h-5 text-primary-500" />
                        Order Items
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 dark:bg-gray-800 text-gray-600 dark:text-gray-400 uppercase text-xs font-semibold">
                            <tr>
                                <th class="px-6 py-3">Product</th>
                                <th class="px-6 py-3 text-center">Qty</th>
                                <th class="px-6 py-3 text-right">Price</th>
                                <th class="px-6 py-3 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach($record->items as $item)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/20 transition">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $item->product->name }}
                                </td>
                                <td class="px-6 py-4 text-center">{{ $item->quantity }}</td>
                                <td class="px-6 py-4 text-right">{{ moneyFormat($item->unit_amount) }}</td>
                                <td class="px-6 py-4 text-right font-semibold">{{ moneyFormat($item->total_amount) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50/50 dark:bg-gray-800/50">
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-right font-medium text-gray-600 dark:text-gray-400">Subtotal</td>
                                <td class="px-6 py-4 text-right font-semibold">{{ moneyFormat($record->grand_total - $record->shipping_amount) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-right font-medium text-gray-600 dark:text-gray-400">Shipping</td>
                                <td class="px-6 py-4 text-right font-semibold">{{ moneyFormat($record->shipping_amount) }}</td>
                            </tr>
                            <tr class="text-lg">
                                <td colspan="3" class="px-6 py-4 text-right font-bold text-primary-600 dark:text-primary-400">Grand Total</td>
                                <td class="px-6 py-4 text-right font-extrabold text-primary-600 dark:text-primary-400 border-t-2 border-primary-500">
                                    {{ moneyFormat($record->grand_total) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Notes -->
            @if($record->notes)
            <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800">
                <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <x-heroicon-o-pencil-square class="w-5 h-5 text-amber-500" />
                    Customer Notes
                </h3>
                <p class="text-gray-700 dark:text-gray-300 bg-amber-50/50 dark:bg-amber-900/10 p-4 rounded-lg border border-amber-100 dark:border-amber-900/20 italic">
                    "{{ $record->notes }}"
                </p>
            </div>
            @endif
        </div>

        <!-- Sidebar Details -->
        <div class="space-y-6">
            <!-- Order Metadata -->
            <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800">
                <div class="flex items-center justify-between mb-6">
                    <span class="px-3 py-1 bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-400 rounded-full text-xs font-bold ring-1 ring-primary-100 dark:ring-primary-900/30">
                        #{{ $record->order_number }}
                    </span>
                    <span class="text-sm text-gray-500">{{ $record->created_at->format('M d, Y h:i A') }}</span>
                </div>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500">Status</span>
                        <x-filament::badge :color="$record->status->getColor()" :icon="$record->status->getIcon()">
                            {{ $record->status->getLabel() }}
                        </x-filament::badge>
                    </div>
                    <div class="flex justify-between items-center text-sm border-t border-gray-50 dark:border-gray-800 pt-3">
                        <span class="text-gray-500">Payment Status</span>
                        <x-filament::badge :color="$record->payment_status->getColor()" :icon="$record->payment_status->getIcon()">
                            {{ $record->payment_status->getLabel() }}
                        </x-filament::badge>
                    </div>
                    <div class="flex justify-between items-center text-sm border-t border-gray-50 dark:border-gray-800 pt-3">
                        <span class="text-gray-500">Payment Tool</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $record->payment_method->getLabel() }}</span>
                    </div>
                </div>
            </div>

            <!-- Customer & Shipping -->
            <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800">
                <h3 class="font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                    <x-heroicon-o-user-circle class="w-5 h-5 text-blue-500" />
                    Customer Details
                </h3>
                
                <div class="space-y-5">
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold mb-1">Full Name</p>
                        <p class="text-gray-900 dark:text-white font-medium">{{ $record->address->full_name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold mb-1">Contact Phone</p>
                        <p class="text-gray-900 dark:text-white font-medium">{{ $record->address->phone }}</p>
                    </div>
                    <div class="border-t border-gray-50 dark:border-gray-800 pt-4">
                        <p class="text-xs text-gray-400 uppercase font-bold mb-1">Shipping Address</p>
                        <address class="not-italic text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                            {{ $record->address->street_address }}<br>
                            {{ $record->address->district }}<br>
                            {{ $record->address->division }}
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament::page>
