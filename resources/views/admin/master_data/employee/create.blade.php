@extends('layout.master')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/employee') }}">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tambah Data Pegawai</h6>
                    <form class="forms-sample" action="{{ url('employee') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="input_nip" class="form-label">NIP</label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="input_nip"
                                name="nip" value="{{ old('nip') }}" placeholder="NIP">
                            @error('nip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input_name" class="form-label">Nama Pegawai</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="input_name"
                                name="name" value="{{ old('name') }}" placeholder="Nama Pegawai">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input_email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="input_email"
                                name="email" value="{{ old('email') }}" placeholder="Email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input_phone" class="form-label">No. Hp</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="input_phone"
                                name="phone" value="{{ old('phone') }}" placeholder="No. Hp">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ url('/employee') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
