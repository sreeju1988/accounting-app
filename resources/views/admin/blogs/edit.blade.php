@extends('layouts.theme')

@section('title', 'Edit Blog')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Edit Blog</h4>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" 
                               value="{{ old('title', $blog->title) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" name="category" id="category" class="form-control"
                               value="{{ old('category', $blog->category) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                    <textarea name="content" id="content" rows="8" class="form-control" required>{{ old('content', $blog->content) }}</textarea>
                </div>

                <!-- <div class="mb-3">
                    <label for="image" class="form-label">Featured Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    @if ($blog->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="img-thumbnail" width="200">
                            <p class="text-muted mt-1 mb-0 small">Current image</p>
                        </div>
                    @endif
                </div> -->

                <div class="form-check mb-3">
                    <input type="checkbox" name="is_published" id="is_published" class="form-check-input" value="1"
                           {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
                    <label for="is_published" class="form-check-label">Publish this blog</label>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save"></i> Update Blog
                    </button>
                </div>
            </form>
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
                selector: '#content',
                menubar: false,
                plugins: 'lists link',
                toolbar: 'undo redo | bold italic underline | bullist numlist | link',
                height: 200
            });
        });
    </script>
    @endpush