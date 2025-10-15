@extends('layouts.theme')

@section('content')
<div class="container mt-4">
    <h4>Available Services</h4>
    <div class="row mt-3">
        @forelse($services as $service)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $service->name }}</h5>
                        <p class="card-text text-muted small">
                            {{ Str::limit($service->short_description, 100) }}
                        </p>
                        <p class="mb-1"><strong>Deadline:</strong>
                            {{ $service->deadline ? \Carbon\Carbon::parse($service->deadline)->format('d M Y') : '-' }}
                        </p>
                        <a href="{{ route('agent.services.show', $service->id) }}" class="btn btn-primary btn-sm mt-2">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">No services available</div>
        @endforelse
    </div>
</div>
@endsection
