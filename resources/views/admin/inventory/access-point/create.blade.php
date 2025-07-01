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
            <li class="breadcrumb-item"><a href="{{ route('access-point.index') }}">Inventory (Access Point)</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tambah Access Point</h6>
                    <form class="forms-sample" action="{{ route('access-point.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="Input_nama_ap" class="form-label">Nama Access Point</label>
                            <input type="text" class="form-control @error('nama_ap') is-invalid @enderror"
                                name="nama_ap" id="input_nama_ap" placeholder="Nama Access Point"
                                value="{{ old('nama_ap') }}">
                            @error('nama_ap')
                                <label for="Input_nama_ap"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input_model" class="form-label">Model</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" name="model"
                                id="input_model" placeholder="Model" value="{{ old('model') }}">
                            @error('model')
                                <label for="input_model" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_nomor_seri" class="form-label">Nomor Seri</label>
                            <input type="text" class="form-control @error('nomor_seri') is-invalid @enderror"
                                name="nomor_seri" id="input_nomor_seri" placeholder="Nomor Seri"
                                value="{{ old('nomor_seri') }}">
                            @error('nomor_seri')
                                <label for="Input_nomor_seri"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_mac_address" class="form-label">Mac Address</label>
                            <input type="text" class="form-control @error('mac_address') is-invalid @enderror"
                                name="mac_address" id="input_mac_address" placeholder="Mac Address"
                                value="{{ old('mac_address') }}">
                            @error('mac_address')
                                <label for="Input_mac_address"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>



                        <div class="mb-3">
                            <label for="Input_alamat_ip" class="form-label">Alamat IP (opsional)</label>
                            <input type="text" class="form-control @error('alamat_ip') is-invalid @enderror"
                                name="alamat_ip" id="input_alamat_ip" placeholder="Alamat IP (opsional)"
                                value="{{ old('alamat_ip') }}">
                            @error('alamat_ip')
                                <label for="Input_alamat_ip"
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
                            <label for="select-region-ownership" class="form-label">Status Asset</label>
                            <select id="select-region-ownership" name="status_asset"
                                class="form-select @error('status_asset') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Status --</option>
                                <option value="Aset PLN">Aset PLN</option>
                                <option value="Sewa">Sewa</option>
                            </select>
                            @error('status_asset')
                                <label for="select-region-ownership"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="select-region-ownership" class="form-label">Status</label>
                            <select id="select-region-ownership" name="status"
                                class="form-select @error('status') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Status --</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Non Aktif">Non Aktif</option>
                                <option value="Rusak">Rusak</option>
                                <option value="Cadangan">Cadangan</option>
                            </select>
                            @error('status')
                                <label for="select-region-ownership"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Input_keterangan" class="form-label">Keterangan</label>
                            <textarea type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                id="Input_keterangan" placeholder="Keterangan" rows="3" value="{{ old('keterangan') }}"></textarea>
                            @error('keterangan')
                                <label for="Input_keterangan" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('handphone.index') }}" class="btn btn-secondary" type="reset">Cancel</a>

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
