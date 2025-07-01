@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@push('form-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Dapatkan nilai awal Status Asset saat halaman dimuat
            var initialOwnershipStatus = $('#select-region-ownership').val();
            // Sembunyikan atau tampilkan Vendor berdasarkan nilai awal Status Asset
            if (initialOwnershipStatus === 'Sewa') {
                $('#vendor-select-container').show();
            } else {
                // Mengatur nilai elemen "Vendor" menjadi 'Aset PLN'
                $('#select-region-vendor').val('Aset PLN');
                $('#vendor-select-container').hide();
            }
            $('#select-region-ownership').on('change', function() {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                if (valueSelected == 'Sewa') {
                    $("#vendor-select-container").show();
                } else if (valueSelected == 'Aset PLN') {
                    // Mengganti nilai valueSelected menjadi 'Aset PLN'
                    // Mengatur nilai elemen "Vendor" menjadi 'Aset PLN'
                    $('#select-region-vendor').val('Aset PLN');
                    $("#vendor-select-container").hide();
                } else {
                    $("#vendor-select-container").show();
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
            <li class="breadcrumb-item active" aria-current="page">Ubah</li>
        </ol>
    </nav>

    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Ubah Printer/Scanner</h6>
                    <form class="forms-sample" action="{{ route('printers.update', ['printer' => $printer]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="select-brand" class="form-label">Merk</label>
                            <select id="select-brand" name="brand_id"
                                class="form-select @error('brand_id') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Merek --</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('id', $brand->id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}
                                    </option>
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
                                value="{{ old('user_name', $printer->user_name) }}">
                            @error('user_name')
                                <label for="input-user-name" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="select-region" class="form-label">Kantor Induk</label>
                            <select id="select-region" name="kd_region"
                                class="form-select @error('kd_region') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Kantor --</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->kd_region }}" @selected($region->kd_region == $printer->kd_region)>
                                        {{ $region->nama_region }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kd_region')
                                <label for="select-region" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="select-region-ownership" class="form-label">Status Asset</label>
                            <select id="select-region-ownership" name="ownership_status"
                                class="form-select @error('ownership_status') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Kepemilikan --</option>
                                <option value="Aset PLN" {{ $printer->ownership_status === 'Aset PLN' ? 'selected' : '' }}>
                                    Aset PLN</option>
                                <option value="Sewa" {{ $printer->ownership_status === 'Sewa' ? 'selected' : '' }}>Sewa
                                </option>
                            </select>
                            @error('ownership_status')
                                <label for="select-region-ownership" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3" id="vendor-select-container">
                            <label for="select-region-vendor" class="form-label">Vendor</label>
                            <select id="select-region-vendor" name="vendor"
                                class="form-select @error('vendor') is-invalid @enderror" data-width="100%">
                                <option value="Aset PLN"
                                    {{ old('ownership_status', $printer->ownership_status) === 'Sewa' ? 'selected' : '' }}>
                                    -- Pilih Vendor --
                                </option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->name }}"
                                        {{ old('vendor', $printer->vendor) === $vendor->name ? 'selected' : '' }}>
                                        {{ $vendor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vendor_id')
                                <label for="select-region-vendor" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input-year" class="form-label">Tahun</label>
                            <input type="number" class="form-control @error('year') is-invalid @enderror" name="year"
                                id="input-year" placeholder="Tahun" value="{{ old('year', $printer->year) }}"
                                min="2000" max="{{ date('Y') }}">
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
            $("#select-region-ownership").select2();
            $("#select-region-vendor").select2();
            $("#select-region").select2();
        });
    </script>
@endpush
