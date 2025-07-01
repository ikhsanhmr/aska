@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('appslocal.index') }}">Inventory (Apps local)</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
    </nav>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tambah Data Apps local</h6>
                    <form class="forms-sample" action="{{ route('appslocal.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="input_name" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="input_name" name="name" value="{{ old('name') }}"
                                placeholder="Name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="input_link" class="form-label">Link</label>
                            <input type="text" class="form-control @error('link') is-invalid @enderror"
                                id="input_link" name="link" value="{{ old('link') }}"
                                placeholder="Link">
                            @error('link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="input_username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="input_username" name="username" value="{{ old('username') }}"
                                placeholder="Username">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="input_password" class="form-label">Password</label>
                            <input type="text" class="form-control @error('password') is-invalid @enderror"
                                id="input_password" name="password" value="{{ old('password') }}"
                                placeholder="Password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="input_database_type" class="form-label">Database type</label>
                            <input type="text" class="form-control @error('database_type') is-invalid @enderror"
                                id="input_database_type" name="database_type" value="{{ old('database_type') }}"
                                placeholder="Database type">
                            @error('database_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('appslocal.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
        </div>
        @endsection

        @push('plugin-scripts')
        <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
        @endpush

        @push('custom-scripts')
        <script>
            $(function() {
                $("#select-region").select2();
            });
        </script>
        @endpush
