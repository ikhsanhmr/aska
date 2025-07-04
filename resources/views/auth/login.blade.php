{{-- @extends('layout.master2')

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
@endsection --}}

@extends('layout.login')

@section('login')
  <div class="absolute top-0 left-0 p-8">
    <img
      src="{{ asset('images/logo.png') }}"
      alt="PLN Nusa Daya logo"
      class="w-30 h-20 object-contain"
    />
  </div>

  <div class="min-h-screen w-full flex flex-col md:flex-row">

    <div class="md:w-2/3 bg-[#f5f6f8] flex flex-col justify-center items-center p-6 md:p-12">
      <div class="w-full max-w-lg">
        <img
          src="{{ asset('images/jumbotron.png') }}"
          alt="Illustration of two workers in warehouse"
          class="w-full h-auto object-cover rounded-lg"
          width="450"
          height="200"
        />
      </div>
    </div>

    <div class="md:w-1/3 bg-white flex justify-center items-center p-6 md:p-10">
      <form class="bg-white w-full max-w-md" autocomplete="off" method="POST" action="{{ route('login') }}" novalidate >
        @csrf
        <div class="text-center mb-6">
          <div class="text-xs text-gray-600 font-normal mb-1 uppercase tracking-widest">
            NUSA DAYA EXCELLENCE TOOLS
          </div>
          <h1 class="text-gray-900 font-extrabold text-xl">
            ASSET TRACKING PLATFORM
          </h1>
        </div>

        <label  :value="__('Email')" for="email" class="block text-xs font-normal text-gray-700 mb-1"
          >Email/NIP</label
        >
        <input
          id="email"
          name="email"
          type="text"
          placeholder="Email/NIP"
          class="w-full rounded-md border border-gray-300 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 px-3 py-2 mb-5 text-gray-500 placeholder-gray-400 outline-none"
          required  :value="old('email')" autofocus
        />

        <label for="password" class="block text-xs font-normal text-gray-700 mb-1"
          >Password</label
        >
        <div class="relative mb-5">
          <input
            id="password"
            name="password"
            type="password"
            placeholder="..........."
            class="w-full rounded-md border border-gray-300 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 px-3 py-2 pr-10 text-gray-700 placeholder-gray-400 outline-none"
            required
            autocomplete="current-password"
          />
          <button
            type="button"
            id="togglePassword"
            aria-label="Toggle password visibility"
            class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600"
            tabindex="-1"
          >
            <i class="fas fa-eye-slash"></i>
          </button>
        </div>
        <button
          type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md py-3"
        >
         {{ __('Log in') }}
        </button>
      </form>
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
