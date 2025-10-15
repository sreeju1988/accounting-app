@extends('layouts.theme')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            <div class="col-md-12">

                <div class="card mb-6">
                    <h4 class="card-header">Add Payment</h4>
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif


                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('staff.service_order.store_payment',$booking->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-6">
                                <div class="col-md-6">
                                    <label for="payment_amount" class="form-label">Payment Amount</label>
                                    <input type="number" class="form-control" id="payment_amount" name="payment_amount" placeholder="Enter payment amount" required>
                                    @error('payment_amount') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="payment_mode" class="form-label">Payment Mode</label>
                                    <select class="form-select" id="payment_mode" name="payment_mode" required>
                                        <option value="">Select Payment Mode</option>
                                        <option value="cash">Cash</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                        <option value="upi">UPI</option>
                                        <option value="other">Other</option>
                                    </select>
                                    @error('payment_mode') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>


                            <div class="row g-6">
                                <div class="col-md-6">
                                    <label for="payment_reference" class="form-label">Payment Reference</label>
                                    <input type="text" class="form-control" id="payment_reference" name="payment_reference" placeholder="Enter payment reference" required>
                                    @error('payment_reference') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="payment_note" class="form-label">Payment note (optional)</label>
                                    <input type="text" class="form-control" id="payment_note" name="payment_note" placeholder="Enter payment note">
                                    @error('payment_note') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                            </div>
                            <div class="mt-6">
                                <button type="submit" class="btn btn-primary me-3" type="submit">Add Payment</button>
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