<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Order Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #14213D;
            color: #ffffff;
            padding: 24px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #F2994A;
            font-size: 14px;
        }
        .content {
            padding: 24px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #14213D;
            border-bottom: 2px solid #F2994A;
            padding-bottom: 6px;
            margin-bottom: 16px;
        }
        .info-table, .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table td {
            padding: 6px 0;
            font-size: 14px;
        }
        .info-table td.label {
            font-weight: bold;
            color: #555555;
            width: 130px;
        }
        .items-table th {
            background-color: #f8f9fa;
            color: #14213D;
            text-align: left;
            padding: 10px;
            font-size: 13px;
            border-bottom: 1px solid #eeeeee;
        }
        .items-table td {
            padding: 10px;
            font-size: 14px;
            border-bottom: 1px solid #eeeeee;
        }
        .total-row td {
            font-weight: bold;
            font-size: 16px;
            color: #14213D;
            border-top: 2px solid #14213D;
        }
        .footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 16px;
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Order Received!</h1>
            <p>Order #{{ $order->id }}</p>
        </div>

        <div class="content">
            <div class="section-title">Customer & Delivery Info</div>
            <table class="info-table">
                <tr>
                    <td class="label">Customer Name:</td>
                    <td>{{ $order->name }}</td>
                </tr>
                <tr>
                    <td class="label">Phone:</td>
                    <td><a href="tel:{{ $order->phone }}">{{ $order->phone }}</a></td>
                </tr>
                <tr>
                    <td class="label">Address:</td>
                    <td>{{ $order->address }}</td>
                </tr>
                <tr>
                    <td class="label">Payment Method:</td>
                    <td>{{ strtoupper($order->payment_method ?? 'Cash on Delivery') }}</td>
                </tr>
                <tr>
                    <td class="label">Notes:</td>
                    <td>{{ $order->notes ?? 'N/A' }}</td>
                </tr>
            </table>

            <div class="section-title">Order Items</div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->ordersItems as $item)
                    <tr>
                        <td>{{ $item->item }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ number_format($item->price, 2) }} {{ setting('site_currency') }}</td>
                        <td>{{ number_format($item->total, 2) }} {{ setting('site_currency') }}</td>
                    </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="3" style="text-align: right; padding-right: 15px;">Total Order:</td>
                        <td>{{ number_format($order->total, 2) }} {{ setting('site_currency') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="footer">
            This is an automated notification from {{ config('app.name') }}.
        </div>
    </div>
</body>
</html>
