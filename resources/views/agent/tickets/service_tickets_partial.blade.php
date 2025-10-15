<h5 class="mt-4">Service Related Tickets</h5>
@foreach($service->tickets as $ticket)
<div class="card mb-2">
    <div class="card-body">
        <strong>{{ $ticket->subject }}</strong>
        <span class="badge bg-info">{{ ucfirst($ticket->status) }}</span>
        <a href="{{ route('agent.tickets.show',$ticket->id) }}" class="btn btn-sm btn-primary float-end">View</a>
    </div>
</div>
@endforeach
@if($service->tickets->isEmpty())
    <div class="alert alert-info">No tickets for this service.</div>
@endif
