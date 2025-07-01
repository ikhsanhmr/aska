@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@push('form-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#vendor-select-container').hide();
            $('#select-region-ownership').on('change', function() {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                if (valueSelected == 'Sewa') {

                    $("#vendor-select-container").show();


                } else {

                    $("#vendor-select-container").hide();
                    $('#select-region-vendor').val('Aset PLN');

                }
            });
        });
    </script>
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cctv.index') }}">Inventory (CCTV)</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tambah CCTV</h6>
                    <form class="forms-sample" action="{{ route('cctv.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="select-region-brand" class="form-label">Merk CCTV</label>
                            <select id="select-region-brand" name="brand_id"
                                class="form-select @error('brand_id') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Merek --</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <label for="select-region-brand"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_nama" class="form-label">Nama CCTV</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="input_serial_number" placeholder="Nama CCTV" value="{{ old('nama') }}">
                            @error('nama')
                                <label for="Input_serial_number"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input_model" class="form-label">Model</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" name="model"
                                id="input_model" placeholder="Modelr" value="{{ old('model') }}">
                            @error('model')
                                <label for="input_model" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_nomor_seri" class="form-label">Nomor Seri</label>
                            <input type="text" class="form-control @error('nomor_seri') is-invalid @enderror"
                                name="nomor_seri" id="input_serial_number" placeholder="Nomor Seri"
                                value="{{ old('nomor_seri') }}">
                            @error('nomor_seri')
                                <label for="Input_serial_number"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input_alamat_ip" class="form-label">Alamat IP</label>
                            <input type="text" class="form-control @error('alamat_ip') is-invalid @enderror"
                                name="alamat_ip" id="input_nama_pegawai" placeholder="Alamat IP"
                                value="{{ old('alamat_ip') }}">
                            @error('alamat_ip')
                                <label for="input_nama_pegawai"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="select-region-unit" class="form-label">Kantor Induk</label>
                            <select id="select-region-unit" name="kd_region"
                                class="form-select @error('kd_region') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Kantor --</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->kd_region }}">
                                        {{ $region->nama_region }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kd_region')
                                <label for="select-region-unit"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="select-status_cctv" class="form-label">Status CCTV</label>
                            <select id="select-status_cctv" name="status_cctv"
                                class="form-select @error('status_cctv') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Status --</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Non Aktif">Non Aktif</option>
                                <option value="Rusak">Rusak</option>
                                <option value="Cadangan">Cadangan</option>
                            </select>
                            @error('status_cctv')
                                <label for="select-status_cctv"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input_tanggal_instalasi" class="form-label">Tanggal Instalasi</label>
                            <input type="date" class="form-control @error('tanggal_instalasi') is-invalid @enderror"
                                name="tanggal_instalasi" id="input_tanggal_instalasi" placeholder="Tanggal Instalasi"
                                value="{{ old('tanggal_instalasi') }}">
                            @error('tanggal_instalasi')
                                <label for="input_tanggal_instalasi"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_keterangan" class="form-label">Keterangan</label>
                            <textarea type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                id="Input_keterangan" placeholder="Keterangan" rows="3" value="{{ old('keterangan') }}"></textarea>
                            @error('keterangan')
                                <label for="Input_keterangan"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('cctv.index') }}" class="btn btn-secondary" type="reset">Cancel</a>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
@endpush
@push('custom-scripts')
    <script>
        $(function() {
            $("#select-region-brand").select2();
            $("#select-region-unit").select2();
            $("#select-region-ownership").select2();
            $("#select-region-vendor").select2();
            $("#select-pegawai").select2();
            $('#myDropifyBastp').dropify();
            $('#myDropifyFormPermintaan').dropify();
            $('#myDropifyFoto').dropify();
            $('#myDropifyDataKontrak').dropify();
        });
    </script>
@endpush
