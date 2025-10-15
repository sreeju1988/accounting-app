@extends('layouts.theme')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
              @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
            <div class="d-flex justify-content-between align-items-center p-3">
                <h5 class="card-header mb-0">Invite Staff</h5>
                <a href="{{ route('admin.invitations.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus"></i> Invite New Staff
                </a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Email Address</th>
                            <th>Accepted Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($invitations as $invitation)
                        <tr>
                            <td>
                                 <span>{{ $invitation->email }}</span>
                            </td>
                            <td>
                                @if($invitation->accepted==1)
                                    <span class="badge bg-label-success me-1">Accepted</span>
                                @elseif($invitation->accepted==2)
                                    <span class="badge bg-label-danger me-1">Cancelled</span>
                                @else
                                    <span class="badge bg-label-warning me-1">Pending</span>
                                @endif
                            </td>
                            <td>{{ $invitation->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.invitations.resend', $invitation->id) }}"><i class="icon-base bx bx-send me-1"></i> Resend Invitation</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      
    </div>
    <!-- / Content -->


    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->



@endsection