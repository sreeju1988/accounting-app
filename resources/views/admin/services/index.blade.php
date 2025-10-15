@extends('layouts.theme')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h5 class="card-header mb-0">Service List</h5>
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus"></i> Add new Service
                </a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Deadline</th>
                            <th>Required Documents</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $key => $service)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $service->name }}</td>
                            <td>{{ Str::limit($service->short_description, 50) }}</td>
                            <td>{{ $service->deadline ? \Carbon\Carbon::parse($service->deadline)->format('d M Y') : '-' }}</td>
                            <td>
                                @if($service->documents->count() > 0)
                                <ul class="mb-0">
                                    @foreach($service->documents as $doc)
                                    <li>{{ $doc->documentRule->name }}</li>
                                    @endforeach
                                </ul>
                                @else
                                <span class="text-muted">No documents</span>
                                @endif
                            </td>
                            <td>{{ $service->status }}</td>
                            <td>
                                <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <!-- <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this service?')">
                                        Delete
                                    </button>
                                </form> -->
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No services found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    @endsection