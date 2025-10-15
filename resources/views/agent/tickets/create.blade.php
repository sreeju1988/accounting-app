@extends('layouts.theme')

@section('content')
<div class="container mt-4">
    <h2>Create Ticket</h2>
    <form action="{{ route('agent.tickets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control" id="ticketType">
                <option value="general" {{ old('type')=='general'?'selected':'' }}>General</option>
                <option value="service" {{ old('type')=='service'?'selected':'' }}>Service Related</option>
            </select>
        </div>

        <div class="mb-3" id="serviceSelectDiv" style="display: none;">
            <label>Select Service</label>
            <select name="service_booking_id" class="form-control">
                <option value="">-- Select --</option>
                @foreach($services as $s)
                    <option value="{{ $s->id }}" {{ (old('service_booking_id',$serviceId??'')==$s->id)?'selected':'' }}>
                        {{ $s->service->name ?? '-' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Attachment (optional)</label>
            <input type="file" name="attachment" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Create Ticket</button>
    </form>
</div>

<script>
    function toggleServiceSelect() {
        let type = document.getElementById('ticketType').value;
        document.getElementById('serviceSelectDiv').style.display = (type=='service') ? 'block' : 'none';
    }
    document.getElementById('ticketType').addEventListener('change', toggleServiceSelect);
    toggleServiceSelect();
</script>
@endsection
