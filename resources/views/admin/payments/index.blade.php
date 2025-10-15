@extends('layouts.theme')

@section('content')
<div class="container">
    <h4 class="mb-4">Payments for Order #{{ $order->id }} ({{ $order->service->name }})</h4>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Total Fee:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
            <p><strong>Total Paid:</strong> ₹{{ number_format($order->total_paid, 2) }}</p>
            <p><strong>Balance:</strong> ₹{{ number_format($order->balance_due, 2) }}</p>
            <p><strong>Status:</strong> 
                <span class="badge bg-{{ $order->payment_status === 'full' ? 'success' : ($order->payment_status === 'partial' ? 'warning' : 'danger') }}">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </p>
        </div>
    </div>

    <h5>Payment History</h5>
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Date</th>
                <th>Amount</th>
                <th>Method</th>
                <th>Reference</th>
                <th>Recorded By</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->payments as $payment)
            <tr>
                <td>{{ $payment->payment_date ?? $payment->created_at->format('d M Y') }}</td>
                <td>₹{{ number_format($payment->amount, 2) }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>{{ $payment->transaction_reference }}</td>
                <td>{{ $payment->recordedBy?->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
