@extends('layout.master2')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">

    <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-12 ps-md-2">
                            <div class="auth-form-wrapper px-4 py-5">
                                <div class="login-logo page-content d-flex align-items-center justify-content-center">
                                    <div class="login-logo">
                                        <img src="{{ asset('assets/images/Logo.png') }}" width="200" />
                                        {{-- <a href="#"
                                            class="page-content d-flex justify-content-center noble-ui-logo  ">PLN<span>Nusa Daya</span></a> --}}
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('login') }}">

                                    @csrf

                                    <div class="mb-3">
                                        <label for="email" :value="__('Email')" class="form-label">Email
                                            address</label>
                                        <input  type="text" class="form-control" name="email"
                                            :value="old('email')" required autofocus>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" :value="__('Password')" class="form-label">Password</label>
                                        <input tid="password" type="password" name="password" required
                                            autocomplete="current-password" class="form-control">
                                    </div>

                                    <div class="flex items-center justify-end mt-4">

                                        <x-button class="btn btn-primary me-2 mb-2 mb-md-0">
                                            {{ __('Log in') }}
                                        </x-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    @if (session('gagal'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ session('gagal') }}',
                text: '{{ session('infogagal') }}',
            })
        </script>
    @endif
@endsection
