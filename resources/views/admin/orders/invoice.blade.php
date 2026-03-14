<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - #{{ $order->order_number }}</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; line-height: 1.6; margin: 0; padding: 40px; }
        .invoice-box { max-width: 800px; margin: auto; border: 1px solid #eee; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
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
            body { padding: 0; }
            .invoice-box { border: none; box-shadow: none; }
            .no-print { display: none; }
        }
        .print-btn { background: #3b82f6; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin-bottom: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print()" class="print-btn">Print Invoice</button>
    </div>

    <div class="invoice-box">
        <div class="header">
            <div class="logo">
                {{ getSetting('site_name') }}
            </div>
            <div class="invoice-details">
                <h2>INVOICE</h2>
                <p># {{ $order->order_number }}</p>
                <p>Date: {{ $order->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <div class="grid">
            <div>
                <div class="section-title">From</div>
                <strong>{{ getSetting('site_name') }}</strong><br>
                {{ getSetting('shop_address') }}<br>
                Phone: {{ getSetting('phone') }}<br>
                Email: {{ getSetting('site_email') }}
            </div>
            <div>
                <div class="section-title">Bill To</div>
                <strong>{{ $order->address->first_name }} {{ $order->address->last_name }}</strong><br>
                {{ $order->address->street_address }}<br>
                {{ $order->address->area }}, {{ $order->address->district }}<br>
                {{ $order->address->division }} - {{ $order->address->zip_code }}<br>
                Phone: {{ $order->address->phone }}
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: right;">Price</th>
                    <th style="text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td style="text-align: right;">{{ moneyFormat($item->unit_amount) }}</td>
                    <td style="text-align: right;">{{ moneyFormat($item->total_amount) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <div class="total-row">
                <span>Subtotal</span>
                <span>{{ moneyFormat($order->grand_total - $order->shipping_amount) }}</span>
            </div>
            <div class="total-row">
                <span>Shipping</span>
                <span>{{ moneyFormat($order->shipping_amount) }}</span>
            </div>
            <div class="total-row grand-total">
                <span>Total Amount</span>
                <span>{{ moneyFormat($order->grand_total) }}</span>
            </div>
        </div>

        <p style="margin-top: 40px;"><strong>Payment Method:</strong> {{ $order->payment_method->getLabel() }}</p>
        <p><strong>Payment Status:</strong> {{ $order->payment_status->getLabel() }}</p>

        <div class="footer">
            {{ getSetting('footer_text') }}
        </div>
    </div>

    <script>
        // Auto print on load if needed, but manual button is better controlled
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>
