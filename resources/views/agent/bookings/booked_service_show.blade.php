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
                                <a href="javascript:void(0)" class="btn btn-primary mb-1"> <i class="icon-base bx bx-user-check icon-sm me-2"></i>Connected </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
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
                                    <td>{{ $doc->documentRule->name }}</td>
                                    <td>
                                        @if($booking->documents->contains('document_rule_id', $doc->documentRule->id))
                                        <span class="badge bg-success">Uploaded</span>

                                        <a href="#" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this document rule?')) { document.getElementById('delete-form-{{ $doc->id }}').submit(); }"> <i class="icon-base bx bx-trash icon-sm me-2"></i> Delete</a>

                                        <form id="delete-form-{{ $doc->id }}" action="{{ route('agent.bookings.destroyDocument', [$booking->id, $doc->documentRule->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        @else
                                        <span class="badge bg-warning">Pending</span>
                                        <a href="{{ route('agent.bookings.showUploadForm', [$booking->id, $doc->id]) }}" class="btn btn-primary btn-sm"> <i class="icon-base bx bx-user-check icon-sm me-2"></i> Upload Document</a>
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
                       <h5 class="card-action-title mb-0"><i class="icon-base bx bx-bar-chart-alt-2 icon-lg text-body me-4"></i>Service Fees Details</h5>
                       <hr />
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Amount (₹)</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    
                                    <tr>
                                        <td><strong>Total Amount</strong></td>
                                        <td><strong>₹{{ number_format($booking->total_amount, 2) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Amount Paid</td>
                                        <td>₹{{ number_format($booking->amount_paid, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Balance Due</strong></td>
                                        <td><strong>₹{{ number_format($booking->balance_due, 2) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card mb-6">
                    <div class="card-body">
                        <h5 class="card-action-title mb-0"><i class="icon-base bx bx-bar-chart-alt-2 icon-lg text-body me-4"></i>Payment History
                            @if($booking->balance_due <= 0)
                            <a href="{{ route('agent.invoices.download',$booking->id) }}" class="btn btn-primary btn-sm float-end"> <i class="icon-base bx bx-download icon-sm me-2"></i>Download Final Invoice</a>
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


                <div class="col-md-12">
                
                <div class="card mb-6">
                  <h4 class="card-header">Certificates List
                
                  </h4>
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Certificate Name</th>
                                    <th>Uploaded Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($certificates as $certificate)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $certificate->file_title }}</td>
                                    <td>{{ $certificate->created_at->format('d F Y') }}</td>
                                    
                                    <td>
                                        <a href="{{ route('agent.certificates.download', $certificate->id) }}" class="btn btn-sm btn-primary">Download</a>
                                    
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No certificates found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /Account -->
                </div>

            </div>







            </div>
            <div class="col-lg-4 mb-4 order-1">
                    <div class="card card-action mb-3">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0"><i class="icon-base bx bx-bar-chart-alt-2 icon-lg text-body me-4"></i>Staff Details</h5>
                    </div>
                    <div class="card-body">
                            @if($booking->staff)
                            <ul class="list-unstyled mb-0 pt-1">
                                <li class="d-flex align-items-center mb-4"><i class="icon-base bx bx-user"></i><span class="fw-medium mx-2">Name:</span> <span>{{ $booking->staff->name }}</span></li>
                                <li class="d-flex align-items-center mb-4"><i class="icon-base bx bx-envelope"></i><span class="fw-medium mx-2">Email:</span> <span>{{ $booking->staff->email }}</span></li>
                                <li class="d-flex align-items-center mb-4"><i class="icon-base bx bx-phone"></i><span class="fw-medium mx-2">Phone:</span> <span>{{ $booking->staff->phone }}</span></li>
                                <li class="d-flex align-items-center"><i class="icon-base bx bx-briefcase"></i><span class="fw-medium mx-2">Role:</span> <span>{{ $booking->staff->role }}</span></li>
                            </ul>
                            @else
                            <p>No staff assigned yet.</p>
                            @endif
                       


                    </div>
                </div>

                <div class="card card-action mb-6">
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

       

    </div>
    <!-- / Content -->


    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->

@endsection