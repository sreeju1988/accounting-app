@extends('layouts.theme')

@section('content')

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
                        <a class="nav-link " href="{{ route('staff.service_order.show', $booking->id) }}"><i class="icon-base bx bx-user icon-sm me-1_5"></i> Service Order</a>
                      </li>
                    
                      <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="icon-base bx bx-link-alt icon-sm me-1_5"></i>Certificates</a>
                      </li>
                    </ul>
                </div>
            
            <div class="col-md-12">
                
                <div class="card mb-6">
                  <h4 class="card-header">Certificates List
                    <a href="{{ route('staff.certificates.create',$booking->id) }}" class="btn btn-primary float-end">Add Certificate</a>
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
                                        <a href="{{ route('staff.certificates.download', $certificate->id) }}" class="btn btn-sm btn-primary">Download</a>
                                    
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
    </div>
    <!-- / Content -->


    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->



@endsection