@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Edit Service</h4>
    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-sm mb-3">← Back to List</a>

    <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Service Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $service->name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $service->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Deadline (optional)</label>
            <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $service->deadline) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Required Documents</label>
            <div class="border rounded p-2">
                @foreach($documentRules as $rule)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="document_rules[]" value="{{ $rule->id }}" 
                               id="rule{{ $rule->id }}"
                               {{ in_array($rule->id, $selectedRules) ? 'checked' : '' }}>
                        <label class="form-check-label" for="rule{{ $rule->id }}">
                            {{ $rule->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Service</button>
    </form>
</div>
@endsection
