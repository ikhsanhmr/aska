@extends('layout.master2')

@section('content')
    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        {{-- <div class="col-md-4 pe-md-0">
                            <div class="auth-side-wrapper"
                                style="background-image: url({{ url('https://via.placeholder.com/219x452') }})">

                            </div>
                        </div> --}}
                        <div class="col-md-12 ps-md-2">
                            <div class="auth-form-wrapper px-4 py-5">
                                <div class="login-logo ">
                                    <div class="login-brand">
                                        <img src="{{ asset('assets/images/logo.png') }}" alt="logo" width="100" />
                                    </div>
                                </div>
                                <a href="#" class="noble-ui-logo d-block mb-2">PLN<span>Nusa Daya</span></a>
                                <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                                <form class="forms-sample">
                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="userEmail" placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="userPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="userPassword"
                                            autocomplete="current-password" placeholder="Password">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0">Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
