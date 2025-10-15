@extends('layouts.theme')
@section('content')


<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h5 class="card-header mb-0">All Support Tickets</h5>
                
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Subject</th>
                            <th>Assigned To</th>
                            <th>Agent Name</th>
                            <th>Created At</th>
                            <th>Last Updated</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $key => $ticket)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $ticket->subject }}</td>
                            <td>{{ $ticket->assignedStaff->name ?? '-' }}</td>
                            <td>{{ $ticket->agent->name }}</td>
                            <td>{{ $ticket->created_at->format('d M Y H:i') }}</td>
                            <td>{{ $ticket->updated_at->format('d M Y H:i') }}</td>
                            
                            <td>{{ ucfirst($ticket->status) }}</td>
                            <td>
                                <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-sm btn-primary">View</a>
                            </td>
                            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No tickets found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                    {{ $tickets->links() }}
            </div>
        </div>
    </div>
</div>


@endsection
