@extends('layouts.theme')

@section('title', 'Blog Management')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Blog Management</h5>
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle"></i> Add New Blog
                </a>
            </div>
            <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($blogs->isEmpty())
                    <div class="alert alert-info">
                        No blogs found. Click <strong>Add New Blog</strong> to create one.
                    </div>
                @else
                <div class="table-responsive">
                    <table class="table table-striped mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $index => $blog)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->category ?? '—' }}</td>
                                    <td>{{ $blog->author->name ?? 'Admin' }}</td>
                                    <td>
                                        @if ($blog->is_published)
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-secondary">Draft</span>
                                        @endif
                                    </td>
                                    <td>{{ $blog->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <form action="{{ route('admin.blogs.destroy', $blog->id) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="card-footer">
                {{ $blogs->links('pagination::bootstrap-5') }}
            </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection
