@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
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
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('access-point.index') }}">Inventory (Motor Dinas)</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah</li>
        </ol>
    </nav>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Edit Motor Dinas</h6>
                    <form class="forms-sample" action="{{ route('access-point.update', ['access_point' => $accessPoint->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')


                        <div class="mb-3">
                            <label for="input_nama_ap" class="form-label">Nama Access Point</label>
                            <input type="text" class="form-control @error('nama_ap') is-invalid @enderror"
                                name="nama_ap" id="input_nomor_polisi" placeholder="Nama Access Point"
                                value="{{ old('nama_ap', $accessPoint->nama_ap) }}">
                            @error('nama_ap')
                                <label for="input_nomor_polisi" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputModel" class="form-label">Model</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" name="model"
                                id="inputModel" placeholder="Serial Number" value="{{ old('model', $accessPoint->model) }}">
                            @error('model')
                                <label for="inputModel" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input_nomor_seri" class="form-label">Nomor Seri</label>
                            <input type="text" class="form-control @error('nomor_seri') is-invalid @enderror"
                                name="nomor_seri" id="input_nomor_rangka" placeholder="Nomor Seri"
                                value="{{ old('nomor_seri', $accessPoint->nomor_seri) }}">
                            @error('nomor_seri')
                                <label for="input_nomor_rangka" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input_mac_address" class="form-label">Mac Address</label>
                            <input type="text" class="form-control @error('mac_address') is-invalid @enderror"
                                name="mac_address" id="input_nomor_mesin" placeholder="Mac Address"
                                value="{{ old('mac_address', $accessPoint->mac_address) }}">
                            @error('mac_address')
                                <label for="input_nomor_mesin" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="input_alamat_ip" class="form-label">Alamat IP (opsional)</label>
                            <input type="text" class="form-control @error('alamat_ip') is-invalid @enderror"
                                name="alamat_ip" id="input_tahun_pembuatan" placeholder="Alamat IP (opsional)"
                                value="{{ old('alamat_ip', $accessPoint->alamat_ip) }}">
                            @error('alamat_ip')
                                <label for="input_tahun_pembuatan" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="select-region" class="form-label">Kantor Induk</label>
                            <select id="select-region" name="kd_region"
                                class="form-select @error('kd_region') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Kantor --</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->kd_region }}" @selected($region->kd_region == $accessPoint->kd_region)>
                                        {{ $region->nama_region }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kd_region')
                                <label for="select-region" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="select-status" class="form-label">Status</label>
                            <select id="select-status" name="status"
                                class="form-select @error('status') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Status --</option>
                                <option value="Aktif" {{ $accessPoint->status === 'Aktif' ? 'selected' : '' }}>
                                    Aktif</option>
                                <option value="Non Aktif" {{ $accessPoint->status === 'Non Aktif' ? 'selected' : '' }}>Non Aktif
                                </option>
                                <option value="Rusak" {{ $accessPoint->status === 'Rusak' ? 'selected' : '' }}>Rusak
                                </option>
                                <option value="Cadangan" {{ $accessPoint->status === 'Cadangan' ? 'selected' : '' }}>Cadangan
                                </option>
                            </select>
                            @error('status')
                                <label for="select-region" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="select-region-ownership" class="form-label">Status Asset</label>
                            <select id="select-region-ownership" name="status_asset"
                                class="form-select @error('status_asset') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Status --</option>
                                <option value="Aset PLN" {{ $accessPoint->status_asset === 'Aset PLN' ? 'selected' : '' }}>
                                    Aset PLN</option>
                                <option value="Sewa" {{ $accessPoint->status_asset === 'Sewa' ? 'selected' : '' }}>Sewa
                                </option>
                            </select>
                            @error('status_asset')
                                <label for="select-region" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="InputKeterangan" class="form-label">Keterangan</label>
                            <textarea type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                id="InputKeterangan" placeholder="" rows="3">{{ old('keterangan', $accessPoint->keterangan) }}</textarea>
                            @error('keterangan')
                                <label for="InputKeterangan" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('access-point.index') }}" class="btn btn-secondary" type="reset">Cancel</a>

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
            $("#select-region").select2();
            $('#myDropifyBastp').dropify();
            $('#myDropifyFormPermintaan').dropify();
            $('#myDropifyFoto').dropify();
            $('#myDropifyDataKontrak').dropify();
        });
    </script>
@endpush
