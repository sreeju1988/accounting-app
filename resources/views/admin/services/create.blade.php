@extends('layouts.theme')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-6">
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <h5 class="card-header mb-0">Add New Service</h5>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-primary">
                            <i class="bx bx-plus"></i> Back To List
                        </a>
                    </div>

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-6">

                                <div class="col-md-6">
                                    <label for="name" class="form-label">Service Name</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Service Name" />
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="deadline" class="form-label">Deadline (optional)</label>
                                    <input
                                        class="form-control"
                                        type="date"
                                        id="deadline"
                                        name="deadline"
                                        value="{{ old('deadline') }}"
                                        min="{{ date('Y-m-d') }}" />
                                    @error('deadline') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="short_description" class="form-label">Short Description (optional)</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="short_description"
                                        name="short_description"
                                        value="{{ old('short_description') }}"
                                        placeholder="Short Description" />
                                    @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea
                                        class="form-control"
                                        id="description"
                                        name="description"
                                        rows="6"
                                        placeholder="Description">{{ old('description') }}</textarea>
                                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                               

                                <div class="col-md-12 mt-3">
                                    <label class="form-label">Required Documents</label>
                                    <div class="border rounded p-2">
                                        <div class="d-flex flex-wrap align-items-center gap-3">
                                            @foreach($documentRules as $rule)
                                            <div class="form-check form-check-inline mb-2">
                                                <input class="form-check-input" type="checkbox" name="document_rules[]" value="{{ $rule->id }}" id="rule{{ $rule->id }}">
                                                <label class="form-check-label" for="rule{{ $rule->id }}">
                                                    {{ $rule->name }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary me-2">Create Service</button>
                                    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                <!-- Content wrapper -->

                            </div>  
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>     
                              </div>     
    @endsection
    
    @push('scripts')
    <!-- Include a WYSIWYG editor like TinyMCE or CKEditor -->
    <script src="https://cdn.tiny.cloud/1/r48wq4hhnbrfapvdzk898dszh0g675k2gt25teao2m00ki8b/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tinymce.init({
                selector: '#description',
                menubar: false,
                plugins: 'lists link',
                toolbar: 'undo redo | bold italic underline | bullist numlist | link',
                height: 200
            });
        });
    </script>
    @endpush