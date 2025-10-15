@extends('layouts.theme')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Available Services</h4>
        
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($services->isEmpty())
        <div class="alert alert-info">No services found.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Service</th>
                        <th>Short Description</th>
                        <th>Deadline</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $index => $service)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->short_description }}</td>
                            <td>{{ $service->deadline }}</td>
                            
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('agent.services.show', $service->id) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                       <i class="bi bi-eye"></i> View
                                    </a>

                                   
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
