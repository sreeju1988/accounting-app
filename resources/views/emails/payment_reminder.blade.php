<p>Dear {{ $order->agent->name }},</p>

<p>This is a gentle reminder that your payment for service order <strong>#{{ $order->id }}</strong> is still pending.</p>

<ul>
    <li>Total Service Fee: ₹{{ number_format($order->total_fee, 2) }}</li>
    <li>Amount Paid: ₹{{ number_format($order->payments->sum('amount'), 2) }}</li>
    <li>Outstanding Balance: ₹{{ number_format($balance, 2) }}</li>
</ul>

<p>Please complete the payment at your earliest convenience to avoid any delays in future service processing.</p>

<p>Thank you,<br><strong>{{ config('app.name') }}</strong></p>
