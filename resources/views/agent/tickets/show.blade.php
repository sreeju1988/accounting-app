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
                                    <p class="mt-5">Staff: {{ $ticket->staff->name ?? '-' }}</p>
                                </div>
                                <!-- <a href="javascript:void(0)" class="btn btn-primary mb-1"> <i class="icon-base bx bx-user-check icon-sm me-2"></i>Connected </a> -->
                            </div>
                        </div>

                        
                    </div>
                       <div class="p-3">
                         <h5 class="card-title">Reply</h5>
                        <form action="{{ route('agent.tickets.reply',$ticket->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <textarea name="message" class="form-control" rows="4" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Send Reply</button>
                        </form>
                    </div>
                 
                </div>
              
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
@endsection