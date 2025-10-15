@extends('layouts.theme')

@section('content')

<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-6">
          <h4 class="card-header">Upload Certificate</h4>
          @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          @if($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <div class="card-body">
            <form id="formAccountSettings" method="POST" action="{{ route('staff.certificates.store', $serviceOrder->id) }}" enctype="multipart/form-data">
              @csrf
              <div class="row g-6">
                <div class="col-md-6">
                  <label class="form-label">Service Order</label>
                  <input type="text" class="form-control" value="{{ $serviceOrder->service_order_number }}" disabled>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Service Name</label>
                  <input type="text" class="form-control" value="{{ $serviceOrder->service->name }}" disabled>
                </div>

                <div class="col-md-6">
                  <label class="form-label">File Title</label>
                  <input type="text" class="form-control" value="{{ old('file_title') }}" required name="file_title" placeholder="Enter file title">
                </div>

                <div class="col-md-6">
                  <label for="files" class="form-label">Select Files</label>
                  <input type="file" name="files[]" id="files" class="form-control" required>
                </div>

                <div class="col-md-12">
                  <label class="form-label">Notes (optional)</label>
                  <textarea name="notes" class="form-control" rows="2"></textarea>
                </div>

                <div class="mt-6">
                  <button type="submit" class="btn btn-primary me-3" type="submit">Add Certificate</button>
                  <a href="{{ route('staff.certificates.index', $serviceOrder->id) }}" class="btn btn-outline-secondary">Back to Certificates</a>
                </div>

            </form>
          </div>
          <!-- /Account -->
        </div>

      </div>
    </div>

  </div>
</div>
<!-- / Content wrapper -->

@endsection