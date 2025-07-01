@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('area.index') }}">Master Data (Area)</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tambah Area</h6>
                    <form class="forms-sample" action="{{ route('area.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="select-region" class="form-label">Region</label>
                            <select id="select-region" name="kd_region" class="form-select @error('kd_region') is-invalid @enderror" data-width="100%"  >                        
                                <option value="">-- Pilih Region --</option>
                                @foreach ($regions as $region)
                                    <option value="{{$region->kd_region}}" {{old('kd_region') == $region->kd_region?'selected':''}}>{{$region->nama_region}}</option>
                                @endforeach
                            </select>
                            @error('kd_region')
                                <label for="select-region" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputKodeArea" class="form-label">Kode Area</label>
                            <input type="number" class="form-control @error('kd_area') is-invalid @enderror" name="kd_area"
                                id="inputKodeArea" placeholder="Kode Area" value="{{ old('kd_area') }}">
                            @error('kd_area')
                                <label for="inputKodeArea" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputNamaArea" class="form-label">Nama Area</label>
                            <input type="text" class="form-control @error('nama_area') is-invalid @enderror"
                                name="nama_area" id="inputNamaArea" placeholder="Nama Area" value="{{ old('nama_area') }}">
                            @error('nama_area')
                                <label for="inputNamaArea" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('area.index') }}" class="btn btn-secondary" type="reset">Cancel</a>
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
