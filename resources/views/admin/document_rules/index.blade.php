@extends('layouts.theme')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h5 class="card-header mb-0">Document List </h5>
                <a href="{{ route('admin.document-rules.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus"></i> Add New Document
                </a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Document Name</th>
                            <th>Allowed Formats</th>
                            <th>Max Size (MB)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                         @forelse($rules as $rule)
                        <tr>
                            <td>
                               <span>{{ $rule->name }}</span>
                            </td>
                            <td>{{ strtoupper($rule->formats) }}</td>
                             <td>{{ $rule->max_size }}</td>
                            
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">                      
                                        <a class="dropdown-item" href="{{ route('admin.document-rules.edit', $rule->id) }}"><i class="icon-base bx bx-pencil me-1"></i> Edit</a>                 
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="if(confirm('Are you sure you want to delete this document rule?')) { document.getElementById('delete-form-{{ $rule->id }}').submit(); }">
                                            <i class="icon-base bx bx-trash me-1"></i><span>Delete</span>
                                        </a>
                                        <form id="delete-form-{{ $rule->id }}" action="{{ route('admin.document-rules.destroy', $rule->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
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