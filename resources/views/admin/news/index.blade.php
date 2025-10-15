@extends('layouts.theme')

@section('content')


<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="d-flex justify-content-between align-items-center p-3">
                <h5 class="card-header mb-0">News List</h5>
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus"></i> Add new News
                </a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Published</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($news as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                {{ $item->published_at ? \Illuminate\Support\Carbon::parse($item->published_at)->format('d M Y') : '-' }}
                            </td>
                            <td>{{ $item->author->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this news?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No news found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $news->links() }}
            </div>
        </div>
    </div>
</div>

@endsection