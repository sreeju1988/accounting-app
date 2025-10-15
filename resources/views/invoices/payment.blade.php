<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $payment->invoice_number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; }
        .details, .summary { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .details th, .details td, .summary th, .summary td {
            border: 1px solid #ccc; padding: 8px;
        }
        .summary td { text-align: right; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .footer { text-align: center; font-size: 11px; color: #777; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/company-logo.png') }}" alt="Logo" height="50"><br>
        <h2>Tax & Compliance Services Pvt Ltd</h2>
        <p>123 Business Street, Kochi, Kerala, India | +91 98765 43210 | info@taxservice.in</p>
        <hr>
        <h3>Payment Invoice</h3>
    </div>

    <table class="details">
        <tr>
            <th>Invoice No:</th>
            <td>{{ $payment->invoice_number }}</td>
            <th>Date:</th>
            <td>{{ $payment->created_at->format('d M Y') }}</td>
        </tr>
        <tr>
            <th>Billed To:</th>
            <td colspan="3">
                {{ $payment->serviceBooking->agent->name ?? 'Agent' }}<br>
                {{ $payment->serviceBooking->agent->email ?? '' }}<br>
                {{ $payment->serviceBooking->agent->phone ?? '' }}
            </td>
        </tr>
        <tr>
            <th>Service:</th>
            <td colspan="3">{{ $payment->serviceBooking->service->name ?? '-' }}</td>
        </tr>
    </table>

    <table class="summary">
        <thead>
            <tr>
                <th class="text-left">Description</th>
                <th class="text-right">Amount (INR)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Service Fee for {{ $payment->service->name ?? 'Service' }}</td>
                <td>{{ number_format($payment->amount, 2) }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Total Amount</th>
                <th>{{ number_format($payment->serviceBooking->totalAmount(), 2) }}</th>
            </tr>
            <tr>
                <th>Total Paid</th>
                <th>{{ number_format($payment->serviceBooking->getTotalPaidAttribute(), 2) }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>This is a computer-generated invoice. No signature required.</p>
    </div>
</body>
</html>
