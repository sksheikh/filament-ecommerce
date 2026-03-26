@vite(['resources/css/app.css'])
<x-filament::page>
    <div class="no-print mb-4 flex justify-end">
        <button onclick="window.print()" class="px-4 py-2 bg-primary-600 text-white rounded shadow hover:bg-primary-500 transition">
            Print Delivery Slip
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
            .signature-section { margin-top: 60px; display: grid; grid-template-columns: 1fr 1fr; gap: 40px; }
            .signature-box { border-top: 1px solid #ccc; padding-top: 10px; text-align: center; }
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
                <h2>DELIVERY SLIP</h2>
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
                <div class="section-title">Ship To</div>
                @if($record->address)
                <strong>{{ $record->address->first_name }} {{ $record->address->last_name }}</strong><br>
                {{ $record->address->street_address }}<br>
                {{ $record->address->area }}, {{ $record->address->district }}<br>
                {{ $record->address->division }} - {{ $record->address->zip_code }}<br>
                Phone: {{ $record->address->phone }}
                @endif
            </div>
        </div>

        <table class="text-gray-900 dark:text-gray-100">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: right;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($record->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td style="text-align: right;">[ ] Shipped</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p class="mt-10 text-gray-900 dark:text-gray-100"><strong>Note:</strong> Please check the items before receiving.</p>

        <div class="signature-section text-gray-900 dark:text-gray-100">
            <div class="signature-box">
                Authorized Signature
            </div>
            <div class="signature-box">
                Customer Signature
            </div>
        </div>

        <div class="footer">
            {{ getSetting('footer_text') }}
        </div>
    </div>
</x-filament::page>
