<x-filament::page>
    <style>
        .order-card { background: white; border-radius: 1rem; border: 1px solid #e5e7eb; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
        .dark .order-card { background: #111827; border-color: #1f2937; }
        .order-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; border-bottom: 1px solid #f3f4f6; padding-bottom: 1rem; }
        .dark .order-header { border-color: #1f2937; }
        .order-grid { display: grid; grid-template-columns: 1fr; gap: 1.5rem; }
        @media (min-width: 1024px) { .order-grid { grid-template-columns: 2fr 1fr; } }
        .order-table { width: 100%; border-collapse: collapse; font-size: 0.875rem; }
        .order-table th { text-align: left; padding: 0.75rem 1rem; color: #6b7280; font-weight: bold; border-bottom: 1px solid #f3f4f6; text-transform: uppercase; font-size: 0.75rem; }
        .order-table td { padding: 1rem; border-bottom: 1px solid #f9fafb; transition: background 0.2s; }
        .dark .order-table th { border-color: #1f2937; color: #9ca3af; }
        .dark .order-table td { border-color: #111827; }
        .total-row { display: flex; justify-content: space-between; padding: 0.5rem 0; font-size: 0.875rem; }
        .grand-total { font-size: 1.25rem; font-weight: 900; color: #4f46e5; border-top: 2px solid #e0e7ff; margin-top: 0.5rem; padding-top: 0.5rem; }
        .dark .grand-total { color: #818cf8; border-color: #312e81; }
        .section-title { font-weight: 800; font-size: 0.875rem; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem; color: #111827; }
        .dark .section-title { color: white; }
        .info-label { font-size: 0.65rem; font-weight: 900; color: #9ca3af; uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem; }
    </style>

    <div class="order-grid">
        <!-- Left Content -->
        <div class="space-y-6">
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <h2 class="text-xl font-black text-gray-900 dark:text-white">Order Breakdown</h2>
                        <p class="text-xs text-gray-500 mt-1">#{{ $record->order_number }} • {{ $record->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                    <div>
                         <x-filament::badge :color="$record->status->getColor()" icon="heroicon-m-sparkles">
                            {{ $record->status->getLabel() }}
                        </x-filament::badge>
                    </div>
                </div>

                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Product Details</th>
                            <th style="text-align: center;">Qty</th>
                            <th style="text-align: right;">Rate</th>
                            <th style="text-align: right;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($record->items as $item)
                        <tr>
                            <td class="font-bold text-gray-900 dark:text-white">{{ $item->product->name }}</td>
                            <td style="text-align: center;">{{ $item->quantity }}</td>
                            <td style="text-align: right; color: #6b7280;">{{ moneyFormat($item->unit_amount) }}</td>
                            <td style="text-align: right;" class="font-black">{{ moneyFormat($item->total_amount) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="margin-top: 1.5rem; display: flex; flex-direction: column; align-items: flex-end;">
                    <div style="width: 100%; max-width: 250px;">
                        <div class="total-row">
                            <span style="color: #6b7280;">Subtotal:</span>
                            <span class="font-bold">{{ moneyFormat($record->grand_total - $record->shipping_amount) }}</span>
                        </div>
                        <div class="total-row">
                            <span style="color: #6b7280;">Shipping:</span>
                            <span class="font-bold">{{ moneyFormat($record->shipping_amount) }}</span>
                        </div>
                        <div class="total-row grand-total">
                            <span>Total:</span>
                            <span>{{ moneyFormat($record->grand_total) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            @if($record->notes)
            <div class="order-card" style="border-left: 4px solid #f59e0b; background: #fffbeb;">
                <div class="section-title" style="color: #92400e;">
                    <x-filament::icon icon="heroicon-o-chat-bubble-left-ellipsis" class="w-5 h-5" />
                    Customer Note
                </div>
                <p style="color: #b45309; font-style: italic; font-size: 0.875rem;">"{{ $record->notes }}"</p>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <div class="order-card">
                <div class="section-title">
                    <x-filament::icon icon="heroicon-o-user" class="w-5 h-5 text-indigo-500" />
                    Customer Details
                </div>
                <div class="space-y-4">
                    <div>
                        <div class="info-label text-gray-400">Recipient Name</div>
                        <div class="font-bold text-gray-900 dark:text-white">{{ $record->address->full_name }}</div>
                    </div>
                    <div>
                        <div class="info-label text-gray-400">Phone Number</div>
                        <div class="font-black text-indigo-600">{{ $record->address->phone }}</div>
                    </div>
                    <div style="border-top: 1px dashed #e5e7eb; padding-top: 1rem;">
                        <div class="info-label text-gray-400 uppercase">Shipping Address</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                            {{ $record->address->street_address }}<br>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $record->address->district }}</span><br>
                            {{ $record->address->division }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="order-card">
                <div class="section-title">
                    <x-filament::icon icon="heroicon-o-credit-card" class="w-5 h-5 text-indigo-500" />
                    Payment & Shipping
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Method:</span>
                        <span class="text-sm font-bold">{{ $record->payment_method->getLabel() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Status:</span>
                        <x-filament::badge :color="$record->payment_status->getColor()">
                            {{ $record->payment_status->getLabel() }}
                        </x-filament::badge>
                    </div>
                    <div class="flex justify-between items-center border-t border-gray-50 pt-3">
                        <span class="text-sm text-gray-500">Delivery via:</span>
                        <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $record->shipping_method->getLabel() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament::page>
