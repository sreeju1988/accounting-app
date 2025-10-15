@extends('layouts.theme')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            <div class="col-md-12">

                <div class="card mb-6">
                    <h4 class="card-header">Book {{ $service->name }}</h4>
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('agent.bookings.createBooking', $service->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-6">


                                <div class="col-md-6">
                                    <label for="client_first_name" class="form-label">Client First Name</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="client_first_name"
                                        name="client_first_name"
                                        value="{{ old('client_first_name') }}"
                                        placeholder="John" />
                                    @error('client_first_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="client_last_name" class="form-label">Client Last Name</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="client_last_name"
                                        name="client_last_name"
                                        value="{{ old('client_last_name') }}"
                                        placeholder="Doe" />
                                    @error('client_last_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="client_phone" class="form-label">Client Phone</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="client_phone"
                                        name="client_phone"
                                        value="{{ old('client_phone') }}"
                                        placeholder="+1234567890" />
                                    @error('client_phone') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="mt-6">
                                    <button type="submit" class="btn btn-primary me-3" type="submit">Create & Continue to Upload Documents</button>
                                    <a href="{{ route('agent.bookings.create') }}" class="btn btn-outline-secondary">Cancel</a>
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