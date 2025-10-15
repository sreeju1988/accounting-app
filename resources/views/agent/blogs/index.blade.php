@extends('layouts.theme')

@section('title', 'Blog Articles')

@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h5 class="card-header mb-0">Our Latest Articles</h5>

                <form method="GET" action="{{ route('agent.blogs.index') }}" class="row g-2 mb-4 pl-3 pr-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Search Articles..." value="{{ request('search') }}">
                </div>

                <div class="col-md-4">
                    <select name="category" class="form-select">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                {{ $category }}
                </option>
            @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>

            </form>
            <hr />
            </div>
            
             @if ($blogs->isEmpty())
        <div class="alert alert-info">
            No blogs found for your selected filters.
        </div>
    @else
        <div class="row g-4 p-3">
            @foreach ($blogs as $blog)
                <div class="col-md-4 mb-3">
                    <a href="{{ route('agent.blogs.show', $blog->id) }}" class=""> <div class="card h-100 shadow-sm border-0">
                        <!-- <img src="{{ $blog->getImageUrlAttribute() }}" class="card-img-top" alt="{{ $blog->title }}"> -->

                        <div class="card-body text-center">
                            <h5 class="card-title">{{ Str::limit($blog->title, 60) }}</h5>
                            @if ($blog->category)
                                <span class="badge bg-info text-dark mb-2">{{ $blog->category }}</span>
                            @endif
                            <p class="card-text text-muted">
                                {{ Str::limit(strip_tags($blog->content), 100) }}
                            </p>
                            <span class="text-muted small">
                                By <strong>{{ $blog->author->name ?? 'Admin' }}</strong> • {{ $blog->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div> </a>
            @endforeach
        </div>
    @endif

        </div>
    </div>
</div>

@endsection
