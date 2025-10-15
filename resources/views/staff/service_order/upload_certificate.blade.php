@extends('layouts.theme')

@section('content')
<div class="card">
  <div class="card-header">
    <h5>Upload Certificates & Acknowledgements</h5>
  </div>
  <div class="card-body">
    <form action="{{ route('admin.certificates.store', $serviceOrder->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="files" class="form-label">Select Files</label>
        <input type="file" name="files[]" id="files" class="form-control" multiple required>
      </div>
      <div class="mb-3">
        <label class="form-label">Notes (optional)</label>
        <textarea name="notes" class="form-control" rows="2"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Upload</button>
    </form>
  </div>
</div>

@endsection