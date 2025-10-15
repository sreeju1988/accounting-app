@extends('layouts.theme')
@section('content')

<!-- Timeline CSS Fix -->
<style>
    body {
        background-color: #f8f9fa;
    }

    .timeline {
        position: relative;
        margin: 30px 0;
        padding: 0;
        list-style: none;
    }

    .timeline::before {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        width: 4px;
        background: #dee2e6;
        left: 30px;
        margin: 0;
        border-radius: 2px;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 30px;
        padding-left: 70px;
    }

    .timeline-item::before {
        content: "";
        position: absolute;
        left: 20px;
        background: #0d6efd;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        top: 5px;
    }

    .timeline-item.completed::before {
        background: #198754;
    }

    .timeline-item .time {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .timeline-item .title {
        font-weight: 600;
        color: #0d6efd;
    }
</style>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                
                <div class="card mb-6">
                     <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="ms-auto">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary">Back</a>
                        </div>
                    </div>
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-8">

                        <div class="flex-grow-1 mt-3 mt-lg-5">
                            <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                           
                                <div class="user-profile-info">
                                    <h4 class="mb-2">#{{$booking->service_order_number}}</h4>
                                    <h5 class="mb-1">{{ $booking->client_first_name }} {{ $booking->client_last_name }}</h5>
                                    <small>{{ $booking->client_phone }}</small>
                                    <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">
                                        <li class="list-inline-item"><i class="icon-base bx bx-palette me-2 align-top"></i><span class="fw-medium">{{ $booking->service->name }}</span></li>
                                        <li class="list-inline-item"><i class="icon-base bx bx-map me-2 align-top"></i><span class="fw-medium"> Status : {{ $booking->status }}</span></li>
                                        <li class="list-inline-item"><i class="icon-base bx bx-calendar me-2 align-top"></i><span class="fw-medium"> Created Date {{ $booking->created_at->format('d F Y') }}</span></li>
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                              data-bs-target="#largeModal">Update Status</button>
                                
                            </div>
                        </div>

                 

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="nav-align-top">
                <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-md-0 gap-2">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="icon-base bx bx-user icon-sm me-1_5"></i> Service Order</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.certificates.index',$booking->id) }}"><i class="icon-base bx bx-link-alt icon-sm me-1_5"></i>Certificates</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-8 mb-4 order-0">
                <div class="card mb-6">
                    <h4 class="card-header">Upload Documents for {{ $booking->service->name }}</h4>

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Document Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                           



                                @foreach($booking->service->documents as $doc)
                                <tr>
                                    <td>{{ $doc->documentRule->name }} </td>
                                    <td>
                                        @if($booking->documents->contains('document_rule_id', $doc->documentRule->id))
                                        <span class="badge bg-success">Uploaded</span>
@foreach($doc->bookings as $uploadedDoc)
                                        <a href="{{ route('admin.document.download', $uploadedDoc->id) }}" class="btn btn-primary btn-sm"> <i class="icon-base bx bx-download icon-sm me-2"></i> Download</a>
@endforeach
                                        <!-- <a href="#" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this document rule?')) { document.getElementById('delete-form-{{ $doc->id }}').submit(); }"> <i class="icon-base bx bx-trash icon-sm me-2"></i> Delete</a>

                                        <form id="delete-form-{{ $doc->id }}" action="{{ route('agent.bookings.destroyDocument', [$booking->id, $doc->documentRule->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form> -->

                                        @else
                                        <span class="badge bg-warning">Pending</span>
                                       
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="card mb-6">
                    <div class="card-body">
                        <h5 class="card-action-title mb-0"><i class="icon-base bx bx-bar-chart-alt-2 icon-lg text-body me-4"></i>Assigned Staff

                            <a href="{{ route('admin.service_order.assign_staff_form', $booking->id) }}" class="btn btn-primary btn-sm float-end"> <i class="icon-base bx bx-user-check icon-sm me-2"></i>@if($booking->staff==null) Assign Staff @else Change Staff @endif</a>

                        </h5>
                        <hr />
                        @if($booking->staff==null)
                        <p class="mt-10">No staff assigned yet.</p>
                        @else
                        <ul class="list-unstyled mb-0 pt-2">
                            <li class="d-flex align-items-center mb-4"><i class="icon-base bx bx-user"></i><span class="fw-medium mx-2">Name:</span> <span>{{ $booking->staff->name }}</span></li>
                            <li class="d-flex align-items-center mb-4"><i class="icon-base bx bx-envelope"></i><span class="fw-medium mx-2">Email:</span> <span>{{ $booking->staff->email }}</span></li>
                            <li class="d-flex align-items-center mb-4"><i class="icon-base bx bx-phone"></i><span class="fw-medium mx-2">Phone:</span> <span>{{ $booking->staff->phone }}</span></li>
                        </ul>
                        @endif
                    </div>
                </div>

                <div class="card mb-6">
                    <div class="card-body">
                        <h5 class="card-action-title mb-0"><i class="icon-base bx bx-bar-chart-alt-2 icon-lg text-body me-4"></i>Agent Details
                        </h5>
                        <hr />
                        @if($booking->agent)
                        <ul class="list-unstyled mb-0 pt-2">
                            <li class="d-flex align-items-center mb-4"><i class="icon-base bx bx-user"></i><span class="fw-medium mx-2">Name:</span> <span>{{ $booking->agent->name }}</span></li>
                            <li class="d-flex align-items-center mb-4"><i class="icon-base bx bx-envelope"></i><span class="fw-medium mx-2">Email:</span> <span>{{ $booking->agent->email }}</span></li>
                            <li class="d-flex align-items-center mb-4"><i class="icon-base bx bx-phone"></i><span class="fw-medium mx-2">Phone:</span> <span>{{ $booking->agent->phone }}</span></li>
                        </ul>
                        @endif
                    </div>
                </div>

                <div class="card mb-6">
                    <div class="card-body">
                        <h5 class="card-action-title mb-0"><i class="icon-base bx bx-bar-chart-alt-2 icon-lg text-body me-4"></i>Payment History
                            @if($booking->balance_due > 0)
                            <a href="{{ route('admin.service_order.add_payment_form',$booking->id) }}" class="btn btn-primary btn-sm float-end"> <i class="icon-base bx bx-user-check icon-sm me-2"></i>Add Payment</a>
                            @else
                            <a href="{{ route('admin.final_invoice.service.download',$booking->id) }}" class="btn btn-primary btn-sm float-end"> <i class="icon-base bx bx-download icon-sm me-2"></i>Download Final Invoice</a>
                            @endif
                        </h5>
                        <hr />
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Reference</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($booking->payments as $payment)
                                <tr>
                                    <td>{{ $payment->payment_date ?? $payment->created_at->format('d M Y') }}</td>
                                    <td>₹{{ number_format($payment->amount, 2) }}</td>
                                    <td>{{ $payment->payment_mode }}</td>
                                    <td>{{ $payment->reference ?? 'N/A' }}</td>
                                   
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>



            </div>
            <div class="col-lg-4 mb-4 order-1">



                <div class="card card-action mb-1">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0"><i class="icon-base bx bx-bar-chart-alt-2 icon-lg text-body me-4"></i>Service Fees Details Order #{{ $booking->id }} ({{ $booking->service->name }})
                            @if($booking->total_amount==0)<a href="{{ route('admin.service_order.add_fees_form', $booking->id) }}" class="btn btn-primary btn-sm float-end"> <i class="icon-base bx bx-user-check icon-sm me-2"></i> Add Amount </a>@endif
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0 pt-1">
                            <li class="d-flex align-items-center mb-4"><i class="icon-base bx bx-money"></i><span class="fw-medium mx-2">Total Fee:</span> <span>₹{{ number_format($booking->total_amount, 2) }}</span></li>
                            <li class="d-flex align-items-center mb-4"><i class="icon-base bx bx-money"></i><span class="fw-medium mx-2">Total Paid:</span> <span>₹{{ number_format($booking->total_paid, 2) }}</span></li>
                            <li class="d-flex align-items-center mb-4"><i class="icon-base bx bx-user"></i><span class="fw-medium mx-2">Balance:</span> <span>₹{{ number_format($booking->balance_due, 2) }}</span></li>
                            <li class="d-flex align-items-center mb-4"><i class="icon-base bx bx-user"></i><span class="fw-medium mx-2">Status:</span> <span class="badge bg-{{ $booking->payment_status === 'paid' ? 'success' : ($booking->payment_status === 'partial' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($booking->payment_status) }}
                                </span></li>
                        </ul>


                    </div>
                </div>


                <div class="card card-action mt-3">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0"><i class="icon-base bx bx-bar-chart-alt-2 icon-lg text-body me-4"></i>Activity Timeline</h5>
                    </div>
                    <div class="card-body pt-3">

                        <ul class="timeline">
                            @if(isset($serviceLogs) && count($serviceLogs))
                            @foreach($serviceLogs as $log)
                            <li class="timeline-item completed">
                                <div class="title">{{ $log['action'] ?? '' }}</div>
                                <div class="time">{{ $log['created_at'] ?? '' }}</div>
                                <p>{{ $log['description'] ?? '' }}</p>
                            </li>
                            @endforeach
                            @else
                            <li class="timeline-item completed">
                                <div class="title">No activities yet</div>
                            </li>
                            @endif
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12 mb-4 order-0">


            </div>
        </div>

    </div>
    <!-- / Content -->


    <!-- / Footer -->

    <div class="content-backdrop fade"></div>


      <!-- Large Modal -->
        <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
            <form action="{{ route('admin.service_order.update_status', $booking->id) }}" method="POST">
                    @csrf
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Update Status</h5>
                <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                        <div class="col mb-6">
                            <label for="nameWithTitle" class="form-label">New Status</label>
                            <select id="nameWithTitle" class="form-select" name="status">
                                <option selected>Choose...</option>
                                <option value="Pending" @if($booking->status == 'Pending') selected @endif>Pending</option>
                                <option value="Documents Pending" @if($booking->status == 'Documents Pending') selected @endif>Documents Pending</option>
                                <option value="Under Review" @if($booking->status == 'Under Review') selected @endif>Under Review</option>
                                <option value="Waiting for Payment" @if($booking->status == 'Waiting for Payment') selected @endif>Waiting for Payment</option>
                                <option value="In Progress" @if($booking->status == 'In Progress') selected @endif>In Progress</option>
                                <option value="Completed" @if($booking->status == 'Completed') selected @endif>Completed</option>
                                <option value="Cancelled" @if($booking->status == 'Cancelled') selected @endif>Cancelled</option>
                            </select>
                        </div>
                </div>

                <div class="row">
                        <div class="col mb-6">
                            <label for="nameWithTitle" class="form-label">Remarks (Optional)</label>
                            <input type="text" class="form-control" name="remarks" id="nameWithTitle" placeholder="Remarks" />
                            
                        </div>
                </div>
                <input type="hidden" id="bookingId" value="{{ $booking->id }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
            </form>
        </div>

</div>
<!-- Content wrapper -->

@endsection