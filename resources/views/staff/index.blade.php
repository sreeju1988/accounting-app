@include('layouts.header')
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->



        @include('layouts.sidebar')

        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            @include('layouts.navbar')

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">

                    <!-- / Content -->

                    <div class="col-12 col-md-8 col-lg-12 col-xxl-4 order-3 order-md-2 profile-report">
                        <div class="row">
                            <div class="col-6 mb-6 payments">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ url('public/theme/assets/img/icons/unicons/paypal.png') }}" alt="paypal" class="rounded">
                                            </div>
                                            <!-- <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                </div>
                                            </div> -->
                                        </div>
                                        <p class="mb-1">Total Payments Received</p>
                                        <h4 class="card-title mb-3"> &#8377; {{ number_format($totalPaymentsReceived, 2) }}</h4>

                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mb-6 payments">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ url('public/theme/assets/img/icons/unicons/paypal.png') }}" alt="paypal" class="rounded">
                                            </div>
                                            <!-- <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                </div>
                                            </div> -->
                                        </div>
                                        <p class="mb-1">Total Payments Pending</p>
                                        <h4 class="card-title mb-3"> &#8377; {{ number_format($totalPaymentsPending, 2) }}</h4>

                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-6 transactions">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ url('public/theme/assets/img/icons/unicons/cc-primary.png') }}" alt="Credit Card" class="rounded">
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                    <a class="dropdown-item" href="{{route('admin.agents.index')}}">View More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-1">Total Number of Agents</p>
                                        <h4 class="card-title mb-3"> {{ $totalAgentsCount }}</h4>

                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mb-6 transactions">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ url('public/theme/assets/img/icons/unicons/cc-primary.png') }}" alt="Credit Card" class="rounded">
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                    <a class="dropdown-item" href="{{ route('admin.staff.index') }}">View More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-1">Total Number of Staff</p>
                                        <h4 class="card-title mb-3">{{ $totalStaffCount }}</h4>

                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mb-6 transactions">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ url('public/theme/assets/img/icons/unicons/cc-primary.png') }}" alt="Credit Card" class="rounded">
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                    <a class="dropdown-item" href="{{ route('admin.services.index') }}">View More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-1">Active Services</p>
                                        <h4 class="card-title mb-3">{{ $totalServices }}</h4>

                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mb-6 transactions">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                            <div class="avatar flex-shrink-0">
                                                <img src="{{ url('public/theme/assets/img/icons/unicons/cc-primary.png') }}" alt="Credit Card" class="rounded">
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                    <a class="dropdown-item" href="{{ route('admin.services.index') }}">View More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-1">In-Active Services</p>
                                        <h4 class="card-title mb-3">{{ $totalInactiveServices }}</h4>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- / Content -->

                <div class="container mt-4">
                    <h3>Support Ticket Analytics</h3>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4>{{ $stats['total'] }}</h4>
                                    <p>Total Tickets</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card text-center bg-warning text-white">
                                <div class="card-body">
                                    <h4>{{ $stats['open'] }}</h4>
                                    <p>Open</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card text-center bg-info text-white">
                                <div class="card-body">
                                    <h4>{{ $stats['in_progress'] }}</h4>
                                    <p>In Progress</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card text-center bg-success text-white">
                                <div class="card-body">
                                    <h4>{{ $stats['resolved'] }}</h4>
                                    <p>Resolved</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card text-center bg-secondary text-white">
                                <div class="card-body">
                                    <h4>{{ $stats['closed'] }}</h4>
                                    <p>Closed</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card text-center bg-danger text-white">
                                <div class="card-body">
                                    <h4>{{ $stats['unassigned'] }}</h4>
                                    <p>Unassigned</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="card text-center bg-danger text-white">
                                <div class="card-body">
                                    <h4>{{ $stats['unreplied'] }}</h4>
                                    <p>Pending Replies</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @include('layouts.footer')

            @include('layouts.script')