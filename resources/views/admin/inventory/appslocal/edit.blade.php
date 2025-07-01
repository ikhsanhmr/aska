@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('appslocal.index') }}">Inventory (Apps local)</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ubah</li>
    </ol>
</nav>

@include('components.alert')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Tambah Apps local</h6>
                <form class="forms-sample" action="{{ route('appslocal.update', ['appslocal' => $appslocal]) }}" method="POST">
                    @csrf
                    @method('PUT')



                    <div class="mb-3">
                        <label for="inputNama" class="form-label">Nama </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" id="inputNama" placeholder="Nama" value="{{ old('name', $appslocal->name) }}">
                        @error('name')
                        <label for="inputNama" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="link" class="form-label">Link</label>
                        <input type="text" class="form-control @error('spesification') is-invalid @enderror"
                        name="link" id="link" placeholder="Link" rows="3" value="{{ old('link', $appslocal->link) }}">
                    @error('link')
                    <label for="Inputlink" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                    name="username" id="username" placeholder="Username" value="{{ old('username', $appslocal->username) }}">
                    @error('user    name')
                    <label for="username" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control @error('password') is-invalid @enderror"
                    name="password" id="password" placeholder="Password" value="{{ old('password', $appslocal->password) }}">
                    @error('password')
                    <label for="password" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="database_type" class="form-label">Database type</label>
                    <input type="text" class="form-control @error('database_type') is-invalid @enderror"
                    name="database_type" id="database_type" placeholder="Database type" value="{{ old('database_type', $appslocal->database_type) }}">
                    @error('database_type')
                    <label for="database_type" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <a href="{{ route('appslocal.index') }}" class="btn btn-secondary" type="reset">Cancel</a>

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
