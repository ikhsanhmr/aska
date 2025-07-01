@extends('layout.master')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/region') }}">Unit Pelaksana</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Edit Data Unit Pelaksana</h6>
                    <form class="forms-sample" action="{{ route('region.update', $region->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="input_kd_region" class="form-label">Kode Unit Pelaksana</label>
                            <input type="number" class="form-control @error('kd_region') is-invalid @enderror"
                                id="input_kd_region" name="kd_region" value="{{ old('kd_region', $region->kd_region) }}"
                                autocomplete="off" placeholder="Kode Unit Pelaksana">
                            @error('kd_region')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="input_nama_region" class="form-label">Nama Unit Pelaksana</label>
                            <input type="text" class="form-control @error('nama_region') is-invalid @enderror"
                                id="input_nama_region" name="nama_region"
                                value="{{ old('nama_region', $region->nama_region) }}" placeholder="Nama Unit Pelaksana">
                            @error('nama_region')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ url('/region') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
