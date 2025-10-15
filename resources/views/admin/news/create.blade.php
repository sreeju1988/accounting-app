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
                        <a href="{{ route('admin.news.index') }}" class="btn btn-primary">
                            <i class="bx bx-plus"></i> Back To List
                        </a>
                    </div>

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-6">

                                <div class="col-md-12">
                                    <label for="title" class="form-label">News Title</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="title"
                                        name="title"
                                        value="{{ old('title') }}"
                                        placeholder="News Title" />
                                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea
                                        class="form-control"
                                        id="content"
                                        name="content"
                                        rows="6"
                                        placeholder="Content">{{ old('content') }}</textarea>
                                    @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary me-2">Add News</button>
                                    <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">Cancel</a>
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