@extends('layouts.theme')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            
            <div class="col-md-12">
                
                <div class="card mb-6">
                  <h4 class="card-header">Invite Agent</h4>
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.invitations.agent.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-6">


                                <div class="col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="john.doe@example.com" />
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>


                                <div class="mt-6">
                                    <button type="submit" class="btn btn-primary me-3" type="submit">Send Invitation</button>
                                    <a href="{{ route('admin.invitations.agent.index') }}" class="btn btn-outline-secondary">Cancel</a>
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