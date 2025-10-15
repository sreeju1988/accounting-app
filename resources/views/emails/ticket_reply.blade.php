<p>Hello {{ $ticket->agent->name }},</p>

<p>You have a new reply on your support ticket: <strong>{{ $ticket->subject }}</strong></p>

<p>Message:</p>
<blockquote>{{ $messageText }}</blockquote>

<p>Ticket Status: {{ ucfirst($ticket->status) }}</p>

<p>You can view the ticket here: <a href="{{ url('/agent/tickets/'.$ticket->id) }}">View Ticket</a></p>

<p>Thanks,<br>Support Team</p>
