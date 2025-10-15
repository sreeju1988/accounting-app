@extends('layouts.theme')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Header -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-6">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">{{ $service->name }}</h4>
                            <a href="{{ route('agent.bookings.clientForm', $service->id)}}" class="btn btn-primary btn-sm"> <i class="icon-base bx bx-user-check icon-sm me-2"></i> Book This Service</a>
                        </div>
                        <p> {!! $service->description !!} </p>
                        <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">
                            <li class="list-inline-item"><i class="icon-base bx bx-calendar me-2 align-top"></i><span class="fw-medium"> {{ $service->deadline ? \Carbon\Carbon::parse($service->deadline)->format('d M Y') : '-' }}</span></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <!--/ Header -->

        <!-- Navbar pills -->
        <div class="row">
            <div class="col-md-12">
                <div class="nav-align-top">
                    <ul class="nav nav-pills flex-column flex-sm-row mb-6 gap-sm-0 gap-2">

                        <li class="nav-item">
                            <a class="nav-link active" href="#"><i class="icon-base bx bx-grid-alt icon-sm me-1_5"></i> Service Order</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!--/ Navbar pills -->

        <!-- User Profile Content -->
        <div class="row">

            <div class="col-xl-12 col-lg-7 col-md-7">

                <!-- Projects table -->
                <div class="card mb-6">
                    <div class="table-responsive mb-4">
                        <div id="DataTables_Table_0_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">

                            <div class="justify-content-between dt-layout-table">
                                <div class="d-md-flex justify-content-between align-items-center dt-layout-full table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Client</th>
                                                <th>Staff</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @forelse($bookedServices as $booking)
                                            <tr>

                                                <td>{{ $booking->client_first_name }} {{ $booking->client_last_name }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-flex flex-column">
                                                            <span class="fw-semibold">{{ $booking->staff->name ?? '-' }}</span>
                                                            <small class="text-muted">{{ $booking->staff->email ?? '-' }}</small>
                                                        </div>
                                                </td>
                                                <td><span class="badge bg-label-danger me-1">{{ $booking->status }}</span></td>
                                                <td>
                                                     <a href="{{ route('agent.bookings.show', $booking->id) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                       <i class="bi bi-eye"></i> View
                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">No bookings found for this service.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!--/ Projects table -->
            </div>
        </div>
        <!--/ User Profile Content -->

    </div>
    <!-- / Content -->

    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
@endsection