<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2, h3, h4 { margin: 0 0 10px 0; }
        .block { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #f2f2f2; }
        .right { text-align: right; }
    </style>
</head>
<body>
    <h2>Pain &amp; Gain - Order #{{ $order->id }}</h2>

    <div class="block">
        <strong>Customer:</strong> {{ $order->fname }} {{ $order->lname }}<br>
        <strong>Email:</strong> {{ $order->email }}<br>
        <strong>Phone:</strong> {{ $order->phoneno }}<br>
    </div>

    <div class="block">
        <strong>Shipping Address:</strong><br>
        {{ $order->address1 }}<br>
        @if($order->address2) {{ $order->address2 }}<br>@endif
        {{ $order->city }}, {{ $order->state }}<br>
        {{ $order->country }} - {{ $order->pincode }}
    </div>

    <h4>Items</h4>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th class="right">Qty</th>
                <th class="right">Price</th>
                <th class="right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->products->name ?? '-' }}</td>
                    <td class="right">{{ $item->qty }}</td>
                    <td class="right">{{ $item->price }}</td>
                    <td class="right">{{ $item->price * $item->qty }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="right">Grand Total: Rs {{ $order->total_price }}</h3>
</body>
</html>
