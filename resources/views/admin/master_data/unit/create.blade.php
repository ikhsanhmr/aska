@extends('layout.master')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/unit') }}">unit</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tambah Data unit</h6>
                    <form class="forms-sample" action="{{ url('unit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="select-region" class="form-label">Region</label>
                            <select id="select-region" name="kd_region"
                                class="form-select @error('kd_region') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Region --</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->kd_region }}"
                                        {{ old('kd_region') == $region->kd_region ? 'selected' : '' }}>
                                        {{ $region->nama_region }}</option>
                                @endforeach
                            </select>
                            @error('kd_region')
                                <label for="select-region" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="select-area" class="form-label">Area</label>
                            <select id="select-area" name="kd_area"
                                class="form-select @error('kd_area') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Area --</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->kd_area }}"
                                        {{ old('kd_area') == $area->kd_area ? 'selected' : '' }}>{{ $area->nama_area }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kd_area')
                                <label for="select-area" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="input_kd_unit" class="form-label">Kode Unit</label>
                            <input type="number" class="form-control @error('kd_unit') is-invalid @enderror"
                                id="input_kd_unit" name="kd_unit" value="{{ old('kd_unit') }}" autocomplete="off"
                                placeholder="Kode unit">
                            @error('kd_unit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="input_nama_unit" class="form-label">Nama Unit</label>
                            <input type="text" class="form-control @error('nama_unit') is-invalid @enderror"
                                id="input_nama_unit" name="nama_unit" value="{{ old('nama_unit') }}"
                                placeholder="Nama unit">
                            @error('nama_unit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ url('/unit') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script>
        $(function() {
            $("#select-area").select2();
        });

        $(function() {
            $("#select-region").select2();
        });
    </script>
@endpush
