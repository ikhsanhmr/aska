@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@push('form-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#vendor-select-container').hide();
            $('#input-ownership-status').on('change', function() {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                if (valueSelected == 'Sewa') {
                    $("#vendor-select-container").show();
                } else {
                    $("#vendor-select-container").hide();
                }
            });
        });
    </script>
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('printers.index') }}">Inventory (Printer)</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>

    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tambah Printer</h6>
                    <form class="forms-sample" action="{{ route('printers.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="select-brand" class="form-label">Merek Printer</label>
                            <select id="select-brand" name="brand_id"
                                class="form-select @error('brand_id') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Merek --</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <label for="select-brand" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input-user-name" class="form-label">Nama Pengguna</label>
                            <input type="text" class="form-control @error('user_name') is-invalid @enderror"
                                name="user_name" id="input-user-name" placeholder="Nama Pengguna"
                                value="{{ old('user_name') }}">
                            @error('name')
                                <label for="input-user-name" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="select-region" class="form-label">Kantor Induk</label>
                            <select id="select-region" name="kd_region"
                                class="form-select @error('kd_region') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Kantor --</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->kd_region }}">
                                        {{ $region->nama_region }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kd_region')
                                <label for="select-region" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input-ownership-status" class="form-label">Status Aset</label>
                            <select id="input-ownership-status" name="ownership_status"
                                class="form-select @error('ownership_status') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Kepemilikan --</option>
                                <option value="Aset PLN">Aset PLN</option>
                                <option value="Sewa">Sewa</option>
                            </select>
                            @error('ownership_status')
                                <label for="input-ownership-status"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3" id="vendor-select-container">
                            <label for="select-region-vendor" class="form-label">Vendor</label>
                            <select id="select-region-vendor" name="vendor"
                                class="form-select @error('vendor') is-invalid @enderror" data-width="100%">
                                <option value="Aset PLN">-- Pilih Vendor --</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->name }}">{{ $vendor->name }}</option>
                                @endforeach
                            </select>
                            @error('vendor_id')
                                <label for="select-region-vendor"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input-year" class="form-label">Tahun</label>
                            <input type="number" class="form-control @error('year') is-invalid @enderror" name="year"
                                id="input-year" placeholder="Tahun" value="{{ old('year') }}" min="2000"
                                max="{{ date('Y') }}">
                            @error('year')
                                <label for="input-year" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('printers.index') }}" class="btn btn-secondary" type="reset">Cancel</a>
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
            $("#select-brand").select2();
            $("#select-unit").select2();
            $("#input-ownership-status").select2();
            $("#select-region-vendor").select2();
            $("#select-region").select2();
        });
    </script>
@endpush
