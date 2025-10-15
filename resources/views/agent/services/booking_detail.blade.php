@extends('layouts.theme')

@section('content')
<div class="container mt-4">
    <a href="{{ route('agent.services.index') }}" class="btn btn-secondary btn-sm mb-3">← Back to Services</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <h4>{{ $booking->service->name }}</h4>
            <p class="text-muted">{{ $booking->service->description }}</p>

            <p><strong>Status:</strong>
                <span class="badge bg-info text-dark">{{ $booking->status }}</span>
            </p>

            @if($booking->amount)
                <p><strong>Amount:</strong> ₹{{ number_format($booking->amount, 2) }}</p>
            @endif

            @if($booking->remarks)
                <p><strong>Remarks:</strong> {{ $booking->remarks }}</p>
            @endif

            <h5 class="mt-4">Uploaded Documents</h5>
            <ul class="list-group">
                @forelse($booking->documents as $doc)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $doc->documentRule->name }}
                        <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            View / Download
                        </a>
                    </li>
                @empty
                    <li class="list-group-item text-muted text-center">No documents uploaded</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
