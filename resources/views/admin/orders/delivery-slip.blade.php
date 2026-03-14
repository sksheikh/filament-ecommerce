<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Slip - #{{ $order->order_number }}</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; line-height: 1.6; margin: 0; padding: 40px; }
        .box { max-width: 800px; margin: auto; border: 2px dashed #ccc; padding: 30px; }
        .header { display: flex; justify-content: space-between; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .logo { font-size: 24px; font-weight: bold; }
        .title { font-size: 24px; font-weight: bold; text-align: right; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-bottom: 40px; }
        .section-title { font-size: 14px; font-weight: bold; text-transform: uppercase; margin-bottom: 10px; background: #eee; padding: 5px 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th { background: #eee; text-align: left; padding: 10px; border: 1px solid #ddd; }
        td { padding: 10px; border: 1px solid #ddd; }
        .footer { margin-top: 50px; display: flex; justify-content: space-between; }
        .sig-box { border-top: 1px solid #333; width: 200px; text-align: center; padding-top: 5px; margin-top: 40px; }
        @media print {
            body { padding: 0; }
            .box { border: 1px solid #000; }
            .no-print { display: none; }
        }
        .print-btn { background: #333; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin-bottom: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print()" class="print-btn">Print Delivery Slip</button>
    </div>

    <div class="box">
        <div class="header">
            <div class="logo">{{ getSetting('site_name') }}</div>
            <div class="title">DELIVERY SLIP</div>
        </div>

        <div class="grid">
            <div>
                <p><strong>Order No:</strong> {{ $order->order_number }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
            </div>
            <div style="text-align: right;">
                <p><strong>Print Date:</strong> {{ now()->format('M d, Y') }}</p>
            </div>
        </div>

        <div class="grid">
            <div>
                <div class="section-title">Shipping To</div>
                <strong>{{ $order->address->first_name }} {{ $order->address->last_name }}</strong><br>
                {{ $order->address->street_address }}<br>
                {{ $order->address->area }}, {{ $order->address->district }}<br>
                {{ $order->address->division }} - {{ $order->address->zip_code }}<br>
                Phone: {{ $order->address->phone }}
            </div>
            <div>
                <div class="section-title">Shipping Method</div>
                <p>{{ $order->shipping_method?->getLabel() ?? 'Standard Delivery' }}</p>
                
                <div class="section-title" style="margin-top: 15px;">Payment Info</div>
                <p>Method: {{ $order->payment_method->getLabel() }}</p>
                <p>Status: {{ $order->payment_status->getLabel() }}</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">SL</th>
                    <th>Product Description</th>
                    <th style="width: 100px; text-align: center;">Qty</th>
                    <th style="width: 150px;">Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($order->notes)
        <div class="section-title">Order Notes</div>
        <p style="padding: 10px; border: 1px solid #ddd; min-height: 50px;">{{ $order->notes }}</p>
        @endif

        <div class="footer">
            <div class="sig-box">Receiver's Signature</div>
            <div class="sig-box">Authorized Signature</div>
        </div>
    </div>
</body>
</html>
