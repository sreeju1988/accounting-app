@extends('layouts.theme')

@section('content')
<div class="container">
    <h4 class="mb-4">Payments for {{ $order->service->name }}</h4>

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

    <div class="card mb-4">
        <div class="card-header bg-light">
            <strong>Add Payment</strong>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('agent.payments.store', $order->id) }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Amount</label>
                        <input type="number" name="amount" class="form-control" step="0.01" required>
                    </div>
                    <div class="col-md-4">
                        <label>Payment Date</label>
                        <input type="date" name="payment_date" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-md-4">
                        <label>Method</label>
                        <select name="payment_method" class="form-select">
                            <option value="">Select</option>
                            <option>Bank Transfer</option>
                            <option>UPI</option>
                            <option>Cash</option>
                            <option>Cheque</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Transaction Reference</label>
                    <input type="text" name="transaction_reference" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Remarks</label>
                    <textarea name="remarks" class="form-control" rows="2"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Add Payment</button>
            </form>
        </div>
    </div>

    <h5>Payment History</h5>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Reference</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->payments as $payment)
                <tr>
                    <td>{{ $payment->payment_date ?? $payment->created_at->format('d M Y') }}</td>
                    <td>₹{{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ $payment->transaction_reference }}</td>
                    <td>{{ $payment->remarks }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
