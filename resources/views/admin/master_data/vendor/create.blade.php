@extends('layout.master')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/vendor') }}">Vendor</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tambah Data Vendor</h6>
                    <form class="forms-sample" action="{{ url('vendor') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="input_name" class="form-label">Nama Vendor</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="input_name"
                                name="name" value="{{ old('name') }}" autocomplete="off" placeholder="Nama Vendor">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="input_address" class="form-label">Alamat </label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                                id="input_address" name="address" value="{{ old('address') }}" placeholder="Alamat vendor">
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="input_telephone" class="form-label">No Telepon</label>
                            <input type="number" class="form-control @error('telephone') is-invalid @enderror"
                                id="input_telephone" name="telephone" value="{{ old('telephone') }}"
                                placeholder="Nomer Telepone">
                            @error('telephone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ url('/vendor') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
