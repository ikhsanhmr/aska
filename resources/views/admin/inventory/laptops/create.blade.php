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
            <li class="breadcrumb-item"><a href="{{ route('area.index') }}">Inventory (Laptop)</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tambah Laptop</h6>
                    <form class="forms-sample" action="{{ route('laptops.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="select-region-brand" class="form-label">Laptop</label>
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
                            <label for="inputNamaLaptop" class="form-label">Nama Laptop</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="inputNamaLaptop" placeholder="Nama Laptop" value="{{ old('name') }}">
                            @error('name')
                                <label for="inputNamaLaptop" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="InputSpesifikasi" class="form-label">Spesifikasi Laptop</label>
                            <textarea type="text" class="form-control @error('spesification') is-invalid @enderror" name="spesification"
                                id="InputSpesifikasi" placeholder="Spesifikasi Laptop" rows="3" value="{{ old('spesification') }}"></textarea>
                            @error('spesification')
                                <label for="InputSpesifikasi" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputNamaPengguna" class="form-label">Nama Pengguna</label>
                            <input type="text" class="form-control @error('user_name') is-invalid @enderror"
                                name="user_name" id="inputNamaPengguna" placeholder="Nama Pengguna"
                                value="{{ old('user_name') }}">
                            @error('user_name')
                                <label for="inputNamaPengguna" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="inputIPAddress" class="form-label">IP Address</label>
                            <input type="text" class="form-control @error('ip_address') is-invalid @enderror"
                                name="ip_address" id="inputIPAddress" placeholder="IP Address"
                                value="{{ old('ip_address') }}">
                            @error('ip_address')
                                <label for="inputIPAddress" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputSerialNumber" class="form-label">Serial Number</label>
                            <input type="text" class="form-control @error('serial_number') is-invalid @enderror"
                                name="serial_number" id="inputSerialNumber" placeholder="Serial Number"
                                value="{{ old('serial_number') }}">
                            @error('serial_number')
                                <label for="inputSerialNumber" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
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
                            <select id="select-region-ownership" name="ownership_status"
                                class="form-select @error('ownership_status') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Status --</option>
                                <option value="Aset PLN">Aset PLN Nusa Daya</option>
                                <option value="Sewa">Sewa</option>
                            </select>
                            @error('ownership_status')
                                <label for="select-region-ownership"
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
                            <label for="inputYear" class="form-label">Tahun</label>
                            <input type="number" class="form-control @error('year') is-invalid @enderror" name="year"
                                id="inputYear" placeholder="Tahun" value="{{ old('year') }}" min="2000"
                                max="{{ date('Y') }}">
                            @error('year')
                                <label for="inputYear" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputTanggalPembelian" class="form-label">Tanggal Pembelian</label>
                            <input type="date" class="form-control @error('tanggal_pembelian') is-invalid @enderror" name="tanggal_pembelian"
                                id="inputTanggalPembelian" placeholder="Tahun" value="{{ old('tanggal_pembelian') }}" min="2000"
                                max="{{ date('Y') }}">
                            @error('tanggal_pembelian')
                                <label for="inputTanggalPembelian" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputBarcode" class="form-label">Barcode</label>
                            <input type="text" class="form-control @error('barcode') is-invalid @enderror"
                                name="barcode" id="inputBarcode" placeholder="Barcode"
                                value="{{ old('barcode') }}">
                            @error('barcode')
                                <label for="inputBarcode" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputHarga" class="form-label">Harga</label>
                            <input type="text" class="form-control @error('harga') is-invalid @enderror"
                                name="harga" id="inputHarga" placeholder="harga"
                                value="{{ old('harga') }}">
                            @error('harga')
                                <label for="inputHarga" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3" id="pegawai-select-container">
                            <label for="select-pegawai" class="form-label">pegawai</label>
                            <select id="select-pegawai" name="pegawai"
                                class="form-select @error('pegawai') is-invalid @enderror" data-width="100%">
                                <option value="Aset PLN">-- Pilih pegawai --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('pegawai')
                                <label for="select-pegawai" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputBast" class="form-label">BAST</label>
                            <input type="file" name="bast" id="myDropify" />
                            @error('bast')
                                <label for="inputBast" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>



                        <div class="mb-3">
                            <label for="inputBastp" class="form-label">BASTP</label>
                            <input type="file" name="bastp" id="myDropifyBastp" />
                            @error('bastp')
                                <label for="inputBastp" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputBastp" class="form-label">Form Permintaan</label>
                            <input type="file" name="form_permintaan" id="myDropifyFormPermintaan" />
                            @error('form_permintaan')
                                <label for="inputBastp" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputBastp" class="form-label">Data Kontrak</label>
                            <input type="file" name="data_kontrak" id="myDropifyDataKontrak" />
                            @error('data_kontrak')
                                <label for="inputBastp" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputBastp" class="form-label">Dokumentasi/Eviden</label>
                            <input type="file" name="foto" id="myDropifyFoto" />
                            @error('foto')
                                <label for="inputBastp" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('laptops.index') }}" class="btn btn-secondary" type="reset">Cancel</a>

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
