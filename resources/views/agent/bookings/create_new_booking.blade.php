@extends('layouts.theme')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            <div class="col-md-12">

                <div class="card mb-6">
                    <h4 class="card-header">Add New Service Booking</h4>
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('agent.bookings.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-6">
                                <div class="col-md-6">
                                    <label for="service_id" class="form-label">Service Name</label>
                                    <select class="form-select" id="service_id" name="service_id" required>
                                        @foreach ($services as $service)
                                        <option value="{{ $service->id }}" selected>{{ $service->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mt-6">
                                    <button type="submit" class="btn btn-primary me-3" type="submit">Create & Continue</button>
                                    <a href="{{ route('agent.bookings.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- /Account -->
                </div>

            </div>
        </div>
    </div>
    <!-- / Content -->


    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
@endsection