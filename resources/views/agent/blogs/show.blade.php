@extends('layouts.theme')

@section('title', $blog->title)

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <!-- @if ($blog->image)
            <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}">
        @endif -->

        <div class="card-body">
            <h3 class="mb-3">{{ $blog->title }}</h3>

            @if ($blog->category)
                <span class="badge bg-info text-dark mb-3">{{ $blog->category }}</span>
            @endif

            <div class="text-muted mb-3">
                By <strong>{{ $blog->author->name ?? 'Admin' }}</strong> • {{ $blog->created_at->format('d M Y') }}
            </div>

            <div class="blog-content">
                {!! nl2br(e($blog->content)) !!}
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('agent.blogs.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Back to Blogs
        </a>
    </div>
</div>
@endsection
