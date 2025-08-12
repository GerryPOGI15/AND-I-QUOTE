<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quotation</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        th { background: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Quotation #{{ $quotation->quotation_code }}</h2>
    <p><strong>Date:</strong> {{ $quotation->quotation_date }}</p>
    <p><strong>Customer:</strong> {{ $customer->name }}<br>
       <strong>Email:</strong> {{ $customer->email }}<br>
       <strong>Address:</strong> {{ $customer->address }}</p>

    <h3>Items</h3>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Unit Cost</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quotation->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_cost, 2) }}</td>
                    <td>{{ number_format($item->quantity * $item->unit_cost, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="text-align:right;">Grand Total: {{ number_format($grandTotal, 2) }}</h3>
</body>
</html>
