@extends('layouts.theme')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            
            <div class="col-md-12">
                
                <div class="card mb-6">
                  <h4 class="card-header">Add new document</h4>
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.document-rules.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-6">


                                <div class="col-md-6">
                                    <label for="name" class="form-label">Document Name</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Document Name" />
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="formats" class="form-label">Allowed Formats</label><br>
                                    @foreach($formats as $format)
                                        <label class="me-2">
                                            <input type="checkbox" name="formats[]" value="{{ $format }}">
                                            {{ strtoupper($format) }}
                                        </label>
                                    @endforeach
                                    @error('formats') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="max_size" class="form-label">Max Size (MB)</label>
                                    <input
                                        class="form-control"
                                        type="number"
                                        id="max_size"
                                        name="max_size"
                                        value="{{ old('max_size') }}"
                                        placeholder="Max Size in MB" />
                                    @error('max_size') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                              

                                <div class="mt-6">
                                    <button type="submit" class="btn btn-primary me-3" type="submit">Add Document</button>
                                    <a href="{{ route('admin.document-rules.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                </div>
                        </form>
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