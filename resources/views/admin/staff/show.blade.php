@extends('layouts.theme')

@section('content')
<!-- Content wrapper -->
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">

                <div class="card mb-6">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Staff Details</h5>
                        <a href="{{ route('admin.staff.index') }}" class="btn btn-sm btn-outline-secondary">Back to List</a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Name:</label>
                                <p class="form-control-plaintext">{{ $user->name }}</p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <label class="form-label">Email:</label>
                                <p class="form-control-plaintext">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Status:</label>
                                <p class="form-control-plaintext">
                                    @if($user->is_active)
                                    <span class="badge bg-label-success me-1">Active</span>
                                    @else
                                    <span class="badge bg-label-warning me-1">Blocked</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <label class="form-label">Created At:</label>
                                <p class="form-control-plaintext">{{ $user->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <form method="POST" action="{{ route('admin.staff.toggle', $user->id) }}">
                            @csrf
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn {{ $user->is_active ? 'btn-danger' : 'btn-success' }}">
                                    {{ $user->is_active ? 'Block' : 'Unblock' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="nav-align-top">
                    <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-md-0 gap-2">
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript:void(0);"><i class="icon-base bx bx-user icon-sm me-1_5"></i>In - Progress Projects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.staff.completed_projects', $user->id)}}"><i class="icon-base bx bx-bell icon-sm me-1_5"></i> Completed / Cancelled Projects</a>
                
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="row"> 
            <div class="col-md-12">
                <div class="card">
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <h5 class="card-header mb-0">In - Progress Projects</h5>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Service Number</th>
                                    <th>Service Title</th>
                                    <th>Agent</th>
                                    <th>Start Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">

                                @forelse($user->inprogress_bookings as $project)

                                <tr>
                                    <td>
                                        <span>{{ $project->service_order_number }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $project->service->name }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $project->staff->name }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $project->created_at->format('d M Y') }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-label-info me-1">{{ $project->status }}</span>
                                    </td>
                                    <td>

                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.service_order.show', $project->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i> View
                                            </a>

                                        </div>

                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">No projects assigned.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Content wrapper -->
@endsection