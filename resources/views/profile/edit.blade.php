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
                            <a class="nav-link active" href="javascript:void(0);"><i class="icon-base bx bx-user icon-sm me-1_5"></i> Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('profile.password.edit')}}"><i class="icon-base bx bx-bell icon-sm me-1_5"></i> Change Password</a>
                        </li>
                       
                    </ul>
                </div>
                <div class="card mb-6">
                    <!-- Account -->
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                                <img
                                    src="{{url('public/theme/assets/img/avatars/1.png')}}"
                                    alt="user-avatar"
                                    class="d-block w-px-100 h-px-100 rounded"
                                    id="uploadedAvatar" />
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="icon-base bx bx-upload d-block d-sm-none"></i>
                                        <input
                                            type="file"
                                            id="upload"
                                            class="account-file-input"
                                            hidden
                                            accept="image/png, image/jpeg" />
                                    </label>

                                    <div>Allowed JPG, GIF or PNG. Max size of 800K</div>
                                </div>
                            </div>
                    </div>
                    <div class="card-body pt-4">

                        <div class="row g-6">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    autofocus />
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    placeholder="john.doe@example.com" />
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="phone">Phone Number</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">IN (+91)</span>
                                    <input
                                        type="text"
                                        id="phone"
                                        name="phone"
                                        class="form-control"
                                        value="{{ old('phone', $user->phone) }}"
                                        placeholder="202 555 0111" />
                                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ old('address', $user->address) }}" />
                                @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mt-6">
                                <button type="submit" class="btn btn-primary me-3" type="submit">Save changes</button>
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