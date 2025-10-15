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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Document Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($booking->service->documents as $doc)
                        
                                <tr>
                                    <td>{{ $doc->documentRule->name }}</td>
                                    <td>
                                        @if($booking->documents->contains('document_rule_id', $doc->documentRule->id))
                                        <span class="badge bg-success">Uploaded</span>

                                        <a href="#" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this document rule?')) { document.getElementById('delete-form-{{ $doc->id }}').submit(); }"> <i class="icon-base bx bx-trash icon-sm me-2"></i> Delete</a>

                                        <form id="delete-form-{{ $doc->id }}" action="{{ route('agent.bookings.destroyDocument', [$booking->id, $doc->documentRule->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        @else
                                        <span class="badge bg-warning">Pending</span>
                                        <a href="{{ route('agent.bookings.showUploadForm', [$booking->id, $doc->id]) }}" class="btn btn-primary btn-sm"> <i class="icon-base bx bx-user-check icon-sm me-2"></i> Upload Document</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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










