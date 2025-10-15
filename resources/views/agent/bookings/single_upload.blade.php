@extends('layouts.theme')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            <div class="col-md-12">

                <div class="card mb-6">
                    <h4 class="card-header">Upload Documents for {{ $booking->service->name }}</h4>
                    
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="card-body">
                        <div class="col-md-6">
                            <form action="{{ route('agent.bookings.storeDocument', $booking->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="document_id" value="{{ $document->id }}">
                                
                                <div class="mb-3">
                                    <label for="document" class="form-label">{{ $document->documentRule->name }}</label>
                                    <input type="file" class="form-control" id="document" name="document" required>
                                    <small class="form-text text-muted">Accepted formats: {{ $document->documentRule->formats }}. Max size: {{$document->documentRule->max_size }}MB.</small>
                                    @error('document')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Upload Document</button>
                                <a href="{{ route('agent.bookings.uploadDocument', $booking->id) }}" class="btn btn-outline-secondary">Back to Document List</a>
                            </form>
                        </div>
                        
                    </div>
                    <!-- /Account -->
                </div>

            </div>
        </div>
    </div>
    <!-- / Content -->


    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
@endsection










