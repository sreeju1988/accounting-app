@extends('layouts.theme')

@section('content')

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        @if($news->count())
        <h5 class="mb-4">Latest News</h5>
        <div class="row mb-12 g-6">
            @foreach($news as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ Str::limit($item->content, 100) }}</p>
                        <p class="card-text">Published on: {{ $item->created_at->format('Y-m-d') }}</p>
                        <button 
                            class="btn btn-sm btn-primary view-news-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#newsModal"
                            data-title="{{ $item->title }}"
                            data-content="{{ e($item->content) }}"
                            data-date="{{ $item->created_at->format('Y-m-d') }}"
                            data-author="{{ $item->author->name ?? 'Unknown' }}"
                        >View Full</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{ $news->links() }}
        @else
        <div class="alert alert-info">No news available.</div>
        @endif
    </div>

    <!-- view the full news article modal -->
    <div class="modal fade" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newsModalLabel">News Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="newsContent">Full news content goes here...</p>
                    <p class="text-muted">Published on: <span id="newsPublishedDate"></span></p>
                    <p class="text-muted">Author: <span id="newsAuthor"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var newsModal = document.getElementById('newsModal');
    var newsTitle = document.getElementById('newsModalLabel');
    var newsContent = document.getElementById('newsContent');
    var newsPublishedDate = document.getElementById('newsPublishedDate');
    var newsAuthor = document.getElementById('newsAuthor');
    var newsCategory = document.getElementById('newsCategory');
    var newsTags = document.getElementById('newsTags');

    document.querySelectorAll('.view-news-btn').forEach(function(btn) {
        btn.addEventListener('click', function () {
            newsTitle.textContent = btn.getAttribute('data-title');
            newsContent.textContent = btn.getAttribute('data-content');
            newsPublishedDate.textContent = btn.getAttribute('data-date');
            newsAuthor.textContent = btn.getAttribute('data-author');
            newsCategory.textContent = btn.getAttribute('data-category');
            newsTags.textContent = btn.getAttribute('data-tags');
        });
    });
});
</script>
@endpush
<!-- / Content -->
    @endsection