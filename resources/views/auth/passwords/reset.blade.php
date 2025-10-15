<!doctype html>
<html
    lang="en"
    class="layout-wide customizer-hide"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ env('APP_NAME') }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ url('public/theme/assets/vendor/fonts/iconify-icons.css') }}" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="{{ url('public/theme/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ url('public/theme/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ url('public/theme/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- endbuild -->

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ url('public/theme/assets/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ url('public/theme/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="{{ url('public/theme/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                              <a href="{{route('home')}}" class="app-brand-link gap-2">
                                 <img src="{{ asset('public/logo.png') }}" alt="Logo" width="200">
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">Reset your password? 🔒</h4>
                       <p class="mb-6">Reset your password by filling the form below.</p>

                        <form id="formAuthentication" class="mb-6" action="{{ route('password.update') }}" method="POST">
                            @csrf
                             <input type="hidden" name="token" value="{{ $token }}">
                            <div class="mb-6">
                                <label for="email" class="form-label">Email</label>
                                <input
                                    type="text"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    name="email"
                                    value="{{ $email ?? old('email') }}"  
                                    placeholder="Enter your email"
                                    required
                                    autocomplete="email"
                                    autofocus />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                                <div class="mb-6">
                                <label for="password" class="form-label">New Password</label>
                                <input
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    placeholder="Enter your new password"
                                    required
                                    autocomplete="new-password" />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input
                                    type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Confirm your new password"
                                    required
                                    autocomplete="new-password"
                                    autofocus />
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                     
                            <button class="btn btn-primary d-grid w-100" type="submit">{{ __('Reset Password') }}</button>
                            
                        </form>
<div class="text-center">
                <a href="auth-login-basic.html" class="d-flex justify-content-center">
                  <i class="icon-base bx bx-chevron-left me-1"></i>
                  Back to login
                </a>
              </div>
                        <!-- <p class="text-center">
                            <span>New on our platform?</span>
                            <a href="auth-register-basic.html">
                                <span>Create an account</span>
                            </a>
                        </p> -->
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    <div class="buy-now">
        <!-- <a
            href="https://themeselection.com/item/sneat-dashboard-pro-bootstrap/"
            target="_blank"
            class="btn btn-danger btn-buy-now">Upgrade to Pro</a> -->
    </div>

    <!-- Core JS -->

    <script src="{{ url('public/theme/assets/vendor/libs/jquery/jquery.js') }}"></script>

    <script src="{{ url('public/theme/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ url('public/theme/assets/vendor/js/bootstrap.js') }}"></script>

    <script src="{{ url('public/theme/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ url('public/theme/assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->

    <script src="{{ url('public/theme/assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>