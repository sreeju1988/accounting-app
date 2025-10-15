@include('layouts.header')
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->



        @include('layouts.sidebar')

        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            @include('layouts.navbar')

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">

                    <!-- / Content -->

                    <div class="col-12 col-md-8 col-lg-12 col-xxl-4 order-3 order-md-2 profile-report">
                        <div class="row">
                            

                            <div class="col-6 mb-6 payments">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ url('public/theme/assets/img/icons/unicons/paypal.png') }}" alt="paypal" class="rounded">
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                    <a class="dropdown-item" href="{{ route('agent.bookings.index', ['status' => 'In Progress']) }}">View More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-1">Completed Services Orders</p>
                                        <h4 class="card-title mb-3">{{ $completedBookingsCount }}</h4>

                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-6 transactions">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ url('public/theme/assets/img/icons/unicons/cc-primary.png') }}" alt="Credit Card" class="rounded">
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                    <a class="dropdown-item" href="{{ route('agent.bookings.index', ['status' => 'In Progress']) }}">View More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-1">In-progress Services Orders</p>
                                        <h4 class="card-title mb-3">{{ $inprogressBookingsCount }}</h4>

                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mb-6 payments">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ url('public/theme/assets/img/icons/unicons/paypal.png') }}" alt="paypal" class="rounded">
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                    <a class="dropdown-item" href="{{ route('agent.bookings.index', ['status' => 'In Progress']) }}">View More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-1">Total Tickets</p>
                                        <h4 class="card-title mb-3">{{ $stats['total'] }}</h4>

                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mb-6 payments">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ url('public/theme/assets/img/icons/unicons/paypal.png') }}" alt="paypal" class="rounded">
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                    <a class="dropdown-item" href="{{ route('agent.bookings.index', ['status' => 'In Progress']) }}">View More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-1">In Progress Tickets</p>
                                        <h4 class="card-title mb-3">{{ $stats['in_progress'] }}</h4>

                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mb-6 payments">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ url('public/theme/assets/img/icons/unicons/paypal.png') }}" alt="paypal" class="rounded">
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                    <a class="dropdown-item" href="{{ route('agent.bookings.index', ['status' => 'In Progress']) }}">View More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-1">Resolved Tickets</p>
                                        <h4 class="card-title mb-3">{{ $stats['resolved'] }}</h4>

                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mb-6 payments">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ url('public/theme/assets/img/icons/unicons/paypal.png') }}" alt="paypal" class="rounded">
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                    <a class="dropdown-item" href="{{ route('agent.bookings.index', ['status' => 'In Progress']) }}">View More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-1">Closed Tickets</p>
                                        <h4 class="card-title mb-3">{{ $stats['closed'] }}</h4>

                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mb-6 payments">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ url('public/theme/assets/img/icons/unicons/paypal.png') }}" alt="paypal" class="rounded">
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                    <a class="dropdown-item" href="{{ route('agent.bookings.index', ['status' => 'In Progress']) }}">View More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-1">Pending Replies</p>
                                        <h4 class="card-title mb-3">{{ $stats['unreplied'] }}</h4>

                                    </div>
                                </div>
                            </div>

                       

                        </div>

                        <div class="row">
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
                                @else
                                <div class="alert alert-info">No news available.</div>
                                @endif

                                  <!-- view more button -->
                        <div class="col-12 text-center mt-4">
                            <a href="{{ route('agent.news.index') }}" class="btn btn-primary">View All News</a>
                        </div>
                        <!-- / view more button -->
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-12 mb-4 mb-lg-0">
                                <h3>Latest Articles</h3>
                            </div>

                        </div>
                        <div class="row row-cols-1 row-cols-md-3 g-6 mb-12">
                            <!-- Blog Card -->
                            @foreach($blogs as $blog)
                            <div class="col">
                                <a href="{{ route('agent.blogs.show', $blog->id) }}">
                                    <div class="card h-100">
                                        <!-- <img class="card-img-top" src="{{ $blog->getImageUrlAttribute() }}" alt="{{ $blog->title }}"> -->
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $blog->title }}</h5>
                                            <p class="card-text">
                                                {{ \Illuminate\Support\Str::limit($blog->content, 120) }}
                                            </p>
                                            <p>Published on: {{ $blog->created_at->format('Y-m-d') }}</p>

                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-sm btn-primary view-news-btn">Read More</button>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach

                       
                        </div>
                         <!-- view more button -->
                        <div class="col-12 text-center mt-4">
                            <a href="{{ route('agent.blogs.index') }}" class="btn btn-primary">View More Articles</a>
                        </div>
                        <!-- / view more button -->


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
                </div>
                <!-- / Content -->

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

                @include('layouts.footer')

                @include('layouts.script')