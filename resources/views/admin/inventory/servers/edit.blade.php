@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('servers.index') }}">Inventory (server)</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah</li>
        </ol>
    </nav>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Ubah Server</h6>
                    <form class="forms-sample" action="{{ route('servers.update', ['server' => $server]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="brand_id" class="form-label">Merk Server</label>
                            <select id="brand_id" name="brand_id"
                                class="form-select @error('brand_id') is-invalid @enderror" data-width="100%">
                                <option value="" disabled>-- Pilih Merk Server --</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('brand_id', $server->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <label for="brand_id" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="information" class="form-label">Keterangan</label>
                            <input type="text" class="form-control @error('information') is-invalid @enderror"
                                name="information" id="information" placeholder="Informasi"
                                value="{{ old('information', $server->information) }}">
                            @error('information')
                                <label for="information" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ip_address" class="form-label">IP Address</label>
                            <input type="text" class="form-control @error('ip_address') is-invalid @enderror"
                                name="ip_address" id="ip_address" placeholder="IP Address"
                                value="{{ old('ip_address', $server->ip_address) }}">
                            @error('ip_address')
                                <label for="ip_address" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="user_name" class="form-label">Username</label>
                            <input type="text" class="form-control @error('user_name') is-invalid @enderror"
                                name="user_name" id="user_name" placeholder="Username"
                                value="{{ old('user_name', $server->user_name) }}">
                            @error('user_name')
                                <label for="user_name" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="Password"
                                value="{{ old('password', $server->password) }}">
                            @error('password')
                                <label for="password" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Nama Pengguna</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" id="username" placeholder="Nama Pengguna"
                                value="{{ old('username', $server->username) }}">
                            @error('username')
                                <label for="username" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="year" class="form-label">Tahun</label>
                            <select id="year" name="year" class="form-select @error('year') is-invalid @enderror"
                                data-width="100%">
                                <option value="" disabled>Pilih Tahun</option>
                                @for ($i = date('Y'); $i <= 2030; $i++)
                                    <option value="{{ $i }}"
                                        {{ old('year', $server->year) == $i ? 'selected' : '' }}>{{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('year')
                                <label for="year" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('servers.index') }}" class="btn btn-secondary" type="reset">Cancel</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush

@push('custom-scripts')
    <script>
        $(function() {
            $("#unit_id").select2();
            $("#brand_id").select2();
            $("#year").select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#ip_address').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^0-9.]/g, '');
                $(this).val(sanitizedValue);
            });
        });
    </script>
@endpush
