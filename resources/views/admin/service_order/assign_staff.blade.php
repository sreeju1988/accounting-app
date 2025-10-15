@extends('layouts.theme')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            
            <div class="col-md-12">
                
                <div class="card mb-6">
                  <h4 class="card-header">Assign Staff</h4>
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.service_order.assign_staff', $booking->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-6">
                                <div class="col-md-6">
                                    <label for="staff_id" class="form-label">Select Staff</label>
                                    <select class="form-select" id="staff_id" name="staff_id">
                                        <option value="">Choose...</option>

                                        @foreach($staffMembers as $staff)
                                            <option value="{{ $staff->id }}" {{ $booking->staff_id == $staff->id ? 'selected' : '' }}>
                                                {{ $staff->name }} - {{ $staff->email }} - {{ $staff->activeBookingsCount() }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('staff_id') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                


                                <div class="mt-6">
                                    <button type="submit" class="btn btn-primary me-3" type="submit">Assign Staff</button>
                                    <a href="{{ route('admin.service_order.show', $booking->id) }}" class="btn btn-outline-secondary">Back To Booking Details</a>
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