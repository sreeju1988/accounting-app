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
                        <h5 class="card-header mb-0">Edit News</h5>
                        <a href="{{ route('admin.news.index') }}" class="btn btn-primary">
                            <i class="bx bx-plus"></i> Back To List
                        </a>
                    </div>

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.news.update', $news->id) }}" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="row g-6">

                                <div class="col-md-12">
                                    <label for="title" class="form-label">News Title</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="title"
                                        name="title"
                                        value="{{ $news->title }}"
                                        placeholder="News Title" required />
                                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea
                                        class="form-control"
                                        id="content"
                                        name="content"
                                        rows="6"
                                        placeholder="Content" required>{{ $news->content }}</textarea>
                                    @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary me-2">Update News</button>
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

<div class="container mt-4">
    <h2>Edit News</h2>

    <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ $news->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control" rows="6" required>{{ $news->content }}</textarea>
        </div>
        <div class="mb-3">
            <label>Current Image</label><br>
            @if($news->image)
                <img src="{{ asset('storage/'.$news->image) }}" alt="" width="150">
            @else
                <p>No image uploaded.</p>
            @endif
        </div>
        <div class="mb-3">
            <label>Change Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
