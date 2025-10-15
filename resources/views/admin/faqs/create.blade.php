@extends('layouts.theme')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Add New FAQ</h5>
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-sm btn-secondary">Back</a>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.faqs.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="question" class="form-label">Question <span class="text-danger">*</span></label>
                            <input type="text" name="question" id="question" class="form-control" value="{{ old('question') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="answer" class="form-label">Answer <span class="text-danger">*</span></label>
                            <textarea name="answer" id="answer" rows="5" class="form-control" required>{{ old('answer') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category (Optional)</label>
                            <input type="text" name="category" id="category" class="form-control" value="{{ old('category') }}" placeholder="e.g. GST, ITR, General">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save FAQ</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
