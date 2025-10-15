<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice - {{ $booking->invoice_number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        td, th { border: 1px solid #ccc; padding: 8px; }
        th { background: #f0f0f0; }
        .footer { text-align: center; font-size: 11px; color: #777; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Service Invoice</h2>
        <p><strong>Invoice No:</strong> {{ $booking->invoice_number }}</p>
        <p><strong>Date:</strong> {{ $booking->invoice_generated_at->format('d M Y') }}</p>
        <p><strong>Payment Status:</strong> {{ ucfirst($booking->payment_status) }}</p>
    </div>
    <!-- Company & Client Details -->
    <p><strong>Company:</strong> {{ config('app.name') }} <br />
    {{ config('app.address') }} <br />
    {{ config('app.email') }} <br />
    {{ config('app.phone') }}</p>

    <p><strong>Agent:</strong> {{ $booking->agent->name ?? 'N/A' }} <br />
    {{ $booking->agent->email ?? 'N/A' }} <br />
    {{ $booking->agent->phone ?? 'N/A' }}</p>
    <p><strong>Service:</strong> {{ $booking->service->name ?? 'N/A' }}</p>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Mode</th>
                <th>Amount (₹)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $p)
            <tr>
                <td>{{ $p->created_at->format('d M Y') }}</td>
                <td>{{ ucfirst($p->payment_mode ?? 'Offline') }}</td>
                <td>{{ number_format($p->amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" style="text-align:right;">Total Paid</th>
                <th>{{ number_format($payments->sum('amount'), 2) }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Thank you for completing your payment!</p>
        <p>Generated on {{ now()->format('d M Y, h:i A') }}</p>
    </div>
</body>
</html>
