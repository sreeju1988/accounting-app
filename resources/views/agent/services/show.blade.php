@extends('layouts.theme')

@section('content')
<div class="container mt-4">
    <a href="{{ route('agent.services.index') }}" class="btn btn-secondary btn-sm mb-3">← Back to Services</a>

    <div class="card shadow-sm">
        <div class="card-body">
            <h4>{{ $service->name }}</h4>
            <p class="text-muted">{!! $service->description !!}</p>

            <p><strong>Deadline:</strong>
                {{ $service->deadline ? \Carbon\Carbon::parse($service->deadline)->format('d M Y') : 'No deadline' }}
            </p>

            <h5 class="mt-4">Required Documents</h5>
            <form action="{{ route('agent.services.store', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @foreach($service->documents as $doc)
                    <div class="mb-3">
                        <label class="form-label">{{ optional($doc->documentRule)->name ?? 'Unknown Document' }}</label>
                        <input type="file" name="documents[{{ optional($doc->documentRule)->id ?? '' }}]" class="form-control" required>
                        <small class="text-muted">
                            Allowed: 
                            @php
                                $formats = [];
                                if (isset($doc->documentRule->formats)) {
                                    $decoded = json_decode($doc->documentRule->formats, true);
                                    if (is_array($decoded)) {
                                        $formats = $decoded;
                                    }
                                }
                            @endphp
                            {{ strtoupper(implode(',', $formats)) ?: 'N/A' }},
                            Max: {{ optional($doc->documentRule)->max_size ?? 'N/A' }} MB
                        </small>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-success mt-2">Book This Service</button>
            </form>
        </div>
    </div>
</div>
@endsection
