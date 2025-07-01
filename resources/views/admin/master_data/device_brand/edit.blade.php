@extends('layout.master')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/device-brand') }}">Merek Perangkat</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Edit Data Merek Perangkat</h6>
                    <form class="forms-sample" action="{{ route('device-brand.update', $deviceBrand->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="input_name" class="form-label">Nama Merek</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="input_name"
                                name="name" value="{{ old('name', $deviceBrand->name) }}" autocomplete="off"
                                placeholder="Nama Merek Perangkat">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="input-category" class="form-label">Kategori</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror"
                                id="input-category" name="category" value="{{ old('category', $deviceBrand->category) }}"
                                placeholder="Kategori">
                            @error('category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ url('/device-brand') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
