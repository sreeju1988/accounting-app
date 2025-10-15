@extends('layouts.theme')

@section('content')

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h5 class="card-header mb-0">Frequently Asked Questions</h5>

                <form method="GET" action="{{ route('agent.faqs.index') }}" class="row g-2 mb-4 pl-3 pr-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search FAQs..." value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>

                <div class="col-md-2">
                    <a href="{{ route('agent.faqs.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
            </form>
            <hr />
            </div>
            
            @if($faqs->count())
            <div class="accordion p-5" id="faqAccordion">
                @foreach($faqs as $faq)
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="heading{{ $faq->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false"
                            aria-controls="collapse{{ $faq->id }}">
                            <strong>{{ $faq->question }}</strong>
                            @if($faq->category)
                            <span class="badge bg-secondary ms-2">{{ $faq->category }}</span>
                            @endif
                        </button>
                    </h2>
                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {!! nl2br(e($faq->answer)) !!}
                            <div class="text-muted small mt-2">
                                Last updated: {{ $faq->updated_at->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-info">No FAQs found.</div>
            @endif

        </div>
    </div>
</div>
@endsection