@extends('layouts.theme')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-align-top">
                    <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-md-0 gap-2">
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('profile.edit')}}"><i class="icon-base bx bx-user icon-sm me-1_5"></i> Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#"><i class="icon-base bx bx-bell icon-sm me-1_5"></i> Change Password</a>
                        </li>
                       
                    </ul>
                </div>
                <div class="card mb-6">
                    <!-- Account -->
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.password.update') }}">
                            @csrf
                        <div class="row g-6">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Current Password</label>
                                <input
                                    class="form-control"
                                    type="password"
                                    id="current_password"
                                    name="current_password"
                                    autofocus />
                                @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="name" class="form-label">New Password</label>
                                <input
                                    class="form-control"
                                    type="password"
                                    id="new_password"
                                    name="new_password"
                                    autofocus />
                                @error('new_password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                             <div class="col-md-6">
                                <label for="name" class="form-label">Confirm New Password</label>
                                <input
                                    class="form-control"
                                    type="password"
                                    id="new_password_confirmation"
                                    name="new_password_confirmation"
                                    autofocus />
                               
                            </div>

                          
                            <div class="mt-6">
                                <button type="submit" class="btn btn-primary me-3" type="submit">Update Password</button>
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                            </form>
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