@extends('layouts.theme')

@section('content')

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h5 class="card-header mb-0">Service Orders ( Cancelled )</h5>
                
            </div>
            <div class="table-responsive text-nowrap">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Service Order</th>
                            <th>Service</th>
                            <th>Client Name</th>
                            <th>Client Phone</th>
                            <th>Status</th>
                            <th>Assigned To</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $index => $booking)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>#{{ $booking->service_order_number }}</td>
                            <td>{{ $booking->service->name }}</td>
                            <td>{{ $booking->client_first_name }} {{ $booking->client_last_name }}</td>
                            <td>{{ $booking->client_phone }}</td>
                            <td>
                                @php
                                $status = ucfirst($booking->status);
                                $badgeClass = match($booking->status) {
                                'Pending' => 'warning',
                                'Under Review' => 'info',
                                'Awaiting_payment' => 'secondary',
                                'Work_in_progress' => 'primary',
                                'Completed' => 'success',
                                'Cancelled' => 'danger',
                                default => 'light',
                                };
                                @endphp
                                <span class="badge bg-{{ $badgeClass }}">{{ $status }}</span>
                            </td>
                            <td>{{ $booking->staff->name ?? 'Not Assigned' }}</td>
                            <td>{{ $booking->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.service_order.show', $booking->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> View
                                    </a>

                                    @if(in_array($booking->status, ['pending', 'under_review']))
                                    <a href="{{ route('agent.bookings.upload', $booking->id) }}"
                                        class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-upload"></i> Upload
                                    </a>
                                    @endif

                                    @if($booking->status === 'completed')
                                    <a href="{{ route('agent.bookings.download', $booking->id) }}"
                                        class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-download"></i> Files
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No cancelled bookings found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection