@vite(['resources/css/app.css'])
<x-filament::page>
    <div class="no-print mb-4 flex justify-end">
        <button onclick="window.print()" class="px-4 py-2 bg-primary-600 text-white rounded shadow hover:bg-primary-500 transition">
            Print Invoice
        </button>
    </div>

    <div class="invoice-box p-8 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
        <style>
            .invoice-box { max-width: 800px; margin: auto; }
            .header { display: flex; justify-content: space-between; margin-bottom: 40px; border-bottom: 2px solid #3b82f6; padding-bottom: 20px; }
            .logo { font-size: 28px; font-weight: bold; color: #3b82f6; }
            .invoice-details { text-align: right; }
            .invoice-details h2 { margin: 0; color: #333; }
            .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-bottom: 40px; }
            .section-title { font-size: 14px; font-weight: bold; color: #666; text-transform: uppercase; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 5px; }
            table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
            th { background: #f8fafc; color: #475569; font-weight: bold; text-align: left; padding: 12px; border-bottom: 2px solid #e2e8f0; }
            td { padding: 12px; border-bottom: 1px solid #f1f5f9; }
            .totals { margin-left: auto; width: 300px; }
            .total-row { display: flex; justify-content: space-between; padding: 8px 0; }
            .grand-total { font-size: 20px; font-weight: bold; color: #3b82f6; border-top: 2px solid #3b82f6; margin-top: 10px; padding-top: 10px; }
            .footer { text-align: center; margin-top: 50px; color: #94a3b8; font-size: 12px; }
            @media print {
                .no-print { display: none !important; }
                .fi-main-ctn { padding: 0 !important; }
                .fi-sidebar { display: none !important; }
                .fi-header { display: none !important; }
                .invoice-box { border: none !important; box-shadow: none !important; }
            }

            .dark .invoice-details h2, .dark .section-title { color: #f3f4f6; }
            .dark th { background: #1f2937; color: #e5e7eb; border-bottom-color: #374151; }
            .dark td { border-bottom-color: #374151; color: #d1d5db; }
        </style>

        <div class="header">
            <div class="logo">
                {{ getSetting('site_name') }}
            </div>
            <div class="invoice-details text-gray-900 dark:text-gray-100">
                <h2>INVOICE</h2>
                <p># {{ $record->order_number }}</p>
                <p>Date: {{ $record->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <div class="grid text-gray-900 dark:text-gray-100">
            <div>
                <div class="section-title">From</div>
                <strong>{{ getSetting('site_name') }}</strong><br>
                {{ getSetting('shop_address') }}<br>
                Phone: {{ getSetting('phone') }}<br>
                Email: {{ getSetting('site_email') }}
            </div>
            <div>
                <div class="section-title">Bill To</div>
                @if($record->address)
                <strong>{{ $record->address->first_name }} {{ $record->address->last_name }}</strong><br>
                {{ $record->address->street_address }}<br>
                {{ $record->address->district }}<br>
                Phone: {{ $record->address->phone }}
                @endif
            </div>
        </div>

        <table class="text-gray-900 dark:text-gray-100">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: right;">Price</th>
                    <th style="text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($record->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td style="text-align: right;">{{ moneyFormat($item->unit_amount) }}</td>
                    <td style="text-align: right;">{{ moneyFormat($item->total_amount) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals text-gray-900 dark:text-gray-100">
            <div class="total-row">
                <span>Subtotal</span>
                <span>{{ moneyFormat($record->grand_total - $record->shipping_amount) }}</span>
            </div>
            <div class="total-row">
                <span>Shipping</span>
                <span>{{ moneyFormat($record->shipping_amount) }}</span>
            </div>
            <div class="total-row grand-total">
                <span>Total Amount</span>
                <span>{{ moneyFormat($record->grand_total) }}</span>
            </div>
        </div>

        <p class="mt-10 text-gray-900 dark:text-gray-100"><strong>Payment Method:</strong> {{ $record->payment_method->getLabel() }}</p>
        <p class="text-gray-900 dark:text-gray-100"><strong>Payment Status:</strong> {{ $record->payment_status->getLabel() }}</p>

        <div class="footer">
            {{ getSetting('footer_text') }}
        </div>
    </div>
</x-filament::page>
