<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->order_number }} - Saffron Sweets & Bakery</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            padding: 20px;
            line-height: 1.6;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 3px solid #f59e0b;
        }

        .company-info h1 {
            color: #f59e0b;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .company-info p {
            color: #666;
            font-size: 14px;
        }

        .invoice-details {
            text-align: right;
        }

        .invoice-details h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .invoice-details p {
            color: #666;
            font-size: 14px;
            margin: 5px 0;
        }

        .invoice-number {
            font-size: 18px;
            font-weight: bold;
            color: #f59e0b;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .billing-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .info-column {
            flex: 1;
        }

        .info-column + .info-column {
            margin-left: 40px;
        }

        .info-content {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 4px;
            border-left: 3px solid #f59e0b;
        }

        .info-content p {
            margin: 5px 0;
            color: #555;
            font-size: 14px;
        }

        .info-content strong {
            color: #333;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table thead {
            background: #f59e0b;
            color: white;
        }

        .items-table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
        }

        .items-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            color: #555;
        }

        .items-table tbody tr:hover {
            background: #f9f9f9;
        }

        .items-table .text-right {
            text-align: right;
        }

        .items-table .text-center {
            text-align: center;
        }

        .totals-section {
            display: flex;
            justify-content: flex-end;
        }

        .totals-table {
            width: 300px;
            border-collapse: collapse;
        }

        .totals-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .totals-table .label {
            color: #666;
        }

        .totals-table .value {
            text-align: right;
            font-weight: 600;
            color: #333;
        }

        .totals-table .total-row {
            background: #f59e0b;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .totals-table .total-row td {
            padding: 15px 10px;
        }

        .totals-table .discount-row .value {
            color: #22c55e;
        }

        .status-section {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #eee;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: #fff3cd;
            color: #f59e0b;
            border: 2px solid #f59e0b;
        }

        .status-processing {
            background: #dbeafe;
            color: #3b82f6;
            border: 2px solid #3b82f6;
        }

        .status-shipped {
            background: #f3e8ff;
            color: #a855f7;
            border: 2px solid #a855f7;
        }

        .status-delivered {
            background: #dcfce7;
            color: #22c55e;
            border: 2px solid #22c55e;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #ef4444;
            border: 2px solid #ef4444;
        }

        .payment-paid {
            background: #dcfce7;
            color: #22c55e;
            border: 2px solid #22c55e;
        }

        .payment-unpaid {
            background: #fff3cd;
            color: #f59e0b;
            border: 2px solid #f59e0b;
        }

        .invoice-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #eee;
            text-align: center;
            color: #666;
            font-size: 12px;
        }

        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 24px;
            background: #f59e0b;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .print-button:hover {
            background: #e0890b;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        @media print {
            .print-button {
                display: none;
            }

            body {
                background: white;
                padding: 0;
            }

            .invoice-container {
                box-shadow: none;
                border-radius: 0;
            }
        }

        @media (max-width: 768px) {
            .invoice-container {
                padding: 20px;
            }

            .billing-info {
                flex-direction: column;
            }

            .info-column + .info-column {
                margin-left: 0;
                margin-top: 20px;
            }

            .invoice-header {
                flex-direction: column;
            }

            .invoice-details {
                text-align: left;
                margin-top: 20px;
            }

            .items-table {
                font-size: 12px;
            }

            .items-table th,
            .items-table td {
                padding: 8px 4px;
            }
        }
    </style>
</head>
<body>
    <button class="print-button" onclick="window.print()">
        <i class="fas fa-print"></i> Print Invoice
    </button>

    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="company-info">
                <h1>Saffron Sweets & Bakery</h1>
                <p>Premium Quality Sweets & Bakery Items</p>
                <p>Email: support@saffron.com | Phone: +880 1XXX-XXXXXX</p>
            </div>
            <div class="invoice-details">
                <h2>INVOICE</h2>
                <p class="invoice-number">#{{ $order->order_number }}</p>
                <p>Date: {{ $order->created_at->format('M d, Y') }}</p>
                <p>Time: {{ $order->created_at->format('g:i A') }}</p>
            </div>
        </div>

        <!-- Billing Information -->
        <div class="billing-info">
            <div class="info-column">
                <div class="section-title">Bill To</div>
                <div class="info-content">
                    @php $address = json_decode($order->shipping_address, true); @endphp
                    <p><strong>{{ $order->user->name ?? 'Guest Customer' }}</strong></p>
                    <p>{{ $address['email'] ?? '' }}</p>
                    <p>{{ $address['phone'] ?? '' }}</p>
                    <p>{{ $address['address'] ?? '' }}</p>
                    <p>{{ $address['city'] ?? '' }}</p>
                </div>
            </div>
            <div class="info-column">
                <div class="section-title">Order Details</div>
                <div class="info-content">
                    <p><strong>Order Number:</strong> #{{ $order->order_number }}</p>
                    <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                    <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method ?? 'N/A') }}</p>
                    <p><strong>Items:</strong> {{ $order->orderItems->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Product</th>
                    <th class="text-center" style="width: 15%;">Quantity</th>
                    <th class="text-right" style="width: 15%;">Unit Price</th>
                    <th class="text-right" style="width: 20%;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr>
                    <td>
                        <strong>{{ $item->product->name ?? 'N/A' }}</strong>
                        @if($item->product && $item->product->sku)
                        <br><small style="color: #999;">SKU: {{ $item->product->sku }}</small>
                        @endif
                    </td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">৳{{ number_format($item->price, 2) }}</td>
                    <td class="text-right"><strong>৳{{ number_format($item->quantity * $item->price, 2) }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals-section">
            <table class="totals-table">
                <tr>
                    <td class="label">Subtotal:</td>
                    <td class="value">৳{{ number_format($order->total_amount, 2) }}</td>
                </tr>
                <tr>
                    <td class="label">Delivery:</td>
                    <td class="value">৳{{ number_format($order->final_amount - $order->total_amount + ($order->discount ?? 0), 2) }}</td>
                </tr>
                @if($order->discount > 0)
                <tr class="discount-row">
                    <td class="label">Discount:</td>
                    <td class="value">-৳{{ number_format($order->discount, 2) }}</td>
                </tr>
                @endif
                <tr class="total-row">
                    <td class="label" style="color: white;">TOTAL:</td>
                    <td class="value" style="color: white;">৳{{ number_format($order->final_amount, 2) }}</td>
                </tr>
            </table>
        </div>

        <!-- Status Section -->
        <div class="status-section">
            <div>
                <span class="section-title">Order Status:</span>
                <span class="status-badge status-{{ $order->status }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
            <div style="text-align: right;">
                <span class="section-title">Payment Status:</span>
                <span class="status-badge payment-{{ $order->payment_status }}">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </div>
        </div>

        <!-- Footer -->
        <div class="invoice-footer">
            <p><strong>Thank you for your order!</strong></p>
            <p>For any queries, please contact us at support@saffron.com</p>
            <p style="margin-top: 10px;">This is a computer-generated invoice and does not require a signature.</p>
            <p>Generated on: {{ now()->format('M d, Y \a\t g:i A') }}</p>
        </div>
    </div>

    <script>
        // Auto print on load (optional - remove if not wanted)
        // window.onload = function() {
        //     setTimeout(function() {
        //         window.print();
        //     }, 500);
        // };
    </script>
</body>
</html>
