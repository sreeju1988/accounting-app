@extends('layouts.theme')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/theme/timeline.css') }}">
@endsection
@section('content')




<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card mb-6">
                     @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
                    <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-8">

                        <div class="flex-grow-1 mt-3 mt-lg-5">
                            <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                                <div class="user-profile-info">
                                    <h4 class="mb-2">{{ $ticket->subject }}</h4>
                                    <h5 class="mb-1">{{ $ticket->client_first_name }} {{ $ticket->client_last_name }}</h5>
                                    <small>{{ $ticket->client_phone }}</small>
                                    <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">
                                        <li class="list-inline-item"><i class="icon-base bx bx-palette me-2 align-top"></i><span class="fw-medium">{{ $ticket->serviceBooking->service->name ?? '-' }}</span></li>
                                        <li class="list-inline-item"><i class="icon-base bx bx-map me-2 align-top"></i><span class="fw-medium"> Status : {{ $ticket->status }}</span></li>
                                        <li class="list-inline-item"><i class="icon-base bx bx-calendar me-2 align-top"></i><span class="fw-medium"> Created Date {{ $ticket->created_at->format('d F Y') }}</span></li>
                                    </ul>
                                    <p class="mt-5">Staff: {{ $ticket->assignedStaff->name ?? '-' }}</p>
                                </div>
                                <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#largeModal"> <i class="icon-base bx bx-edit icon-sm me-2"></i>Update Status </button>
                                <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#assignStaff"> <i class="icon-base bx bx-edit icon-sm me-2"></i>Add/Update Staff</button>
                            </div>
                        </div>
                    </div>
                    @if($ticket->status!='closed')
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Reply</h5>
                            <form action="{{ route('tickets.reply',$ticket->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <textarea name="message" class="form-control" rows="4" required></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Send Reply</button>
                            </form>
                        </div>
                    </div>
                @endif
                </div>
            </div>


            <div class="row">
                <div class="container bootstrap snippets bootdeys">
                    <div class="col-md-9">
                        <div class="timeline-centered timeline-sm">
                            @foreach($messages->reverse() as $msg)
                            <article class="timeline-entry @if($msg->user->role !='agent') left-aligned @endif">
                                <div class="timeline-entry-inner">
                                    <time datetime="2014-01-10T03:45" class="timeline-time"><span>{{ $msg->created_at->format('h:i A') }}</span><span>@if ($msg->created_at->isToday())
                                            Today
                                            @elseif ($msg->created_at->isYesterday())
                                            Yesterday
                                            @else
                                            {{ $msg->created_at->format('M d, Y') }}
                                            @endif</span></time>
                                    <div class="timeline-icon @if($msg->user->role !='agent') bg-dark @else bg-blue @endif"><i class="fa fa-exclamation"></i></div>
                                    <div class="timeline-label @if($msg->user->role !='agent') bg-dark @else bg-blue @endif">
                                        <p>{{$msg->user->name ?? 'N/A'  }} ( {{$msg->user->roleType() }} )</p>
                                        <hr />
                                        <p>{{ $msg->message }}</p>

                                    </div>
                                </div>
                            </article>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




    <!-- Large Modal -->
    <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
        <form action="{{ route('tickets.status',$ticket->id) }}" method="POST">
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
                                    <option value="open" {{ $ticket->status=='open'?'selected':'' }}>Open</option>
                                    <option value="in_progress" {{ $ticket->status=='in_progress'?'selected':'' }}>In Progress</option>
                                    <option value="resolved" {{ $ticket->status=='resolved'?'selected':'' }}>Resolved</option>
                                    <option value="closed" {{ $ticket->status=='closed'?'selected':'' }}>Closed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


     <!--Assign Staff Modal -->
    <div class="modal fade" id="assignStaff" tabindex="-1" aria-hidden="true">
        <form action="{{ route('tickets.assign', $ticket->id) }}" method="POST">
            @csrf
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel3">Add/Update Staff</h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col mb-6">
                                <label for="nameWithTitle" class="form-label">Assign to Staff</label>
                                <select id="nameWithTitle" class="form-select" name="assigned_to">
                                   <option value="">-- Select Staff --</option>
                                        @foreach($staffList as $staff)
                                        <option value="{{ $staff->id }}" {{ ($ticket->assigned_to==$staff->id)?'selected':'' }}>
                                            {{ $staff->name }}
                                        </option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    @endsection