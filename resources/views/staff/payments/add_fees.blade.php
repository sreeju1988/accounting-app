@extends('layouts.theme')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            <div class="col-md-12">

                <div class="card mb-6">
                    <h4 class="card-header">Add Fees</h4>
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('staff.service_order.add_fees', $booking->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-6">
                                <div class="col-md-6">
                                    <label for="fees_amount" class="form-label">Fees Amount</label>
                                    <input type="number" class="form-control" id="fees_amount" name="fees_amount" placeholder="Enter fees amount" required>
                                    @error('fees_amount') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>


                            <div class="mt-6">
                                <button type="submit" class="btn btn-primary me-3" type="submit">Add Fees</button>
                                <a href="{{ route('staff.service_order.show', $booking->id) }}" class="btn btn-outline-secondary">Back To Booking Details</a>
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