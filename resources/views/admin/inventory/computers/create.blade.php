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

                }
            });
        });
    </script>
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('computers.index') }}">Inventory (Komputer)</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>

    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tambah Komputer</h6>
                    <form class="forms-sample" action="{{ route('computers.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="select-brand" class="form-label">Komputer</label>
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
                            <label for="inputNamaLaptop" class="form-label">Nama Komputer</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="inputNamaLaptop" placeholder="Nama Komputer" value="{{ old('name') }}">
                            @error('name')
                                <label for="inputNamaLaptop" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="InputSpesifikasi" class="form-label">Spesifikasi Komputer</label>
                            <textarea type="text" class="form-control @error('spesification') is-invalid @enderror" name="spesification"
                                id="InputSpesifikasi" placeholder="Spesifikasi Komputer" rows="3" value="{{ old('spesification') }}"></textarea>
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
                                <label for="select-region"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="select-region-ownership" class="form-label">Status Asset</label>
                            <select id="select-region-ownership" name="ownership_status"
                                class="form-select @error('ownership_status') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Status --</option>
                                <option value="Aset PLN">Aset PLN</option>
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
                                <label for="select-region" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputOffice" class="form-label">Office</label>
                            <input type="text" class="form-control @error('office') is-invalid @enderror"
                                name="office" id="inputOffice" placeholder="Nama Kantor" value="{{ old('office') }}">
                            @error('office')
                                <label for="inputNamaPengguna"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputSistemOperasi" class="form-label">Sistem Operasi</label>
                            <input type="text" class="form-control @error('system_operation') is-invalid @enderror"
                                name="system_operation" id="inputSistemOperasi" placeholder="Sistem Operasi"
                                value="{{ old('system_operation') }}">
                            @error('system_operation')
                                <label for="inputNamaPengguna"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="inputMonitor" class="form-label">Monitor</label>
                            <input type="text" class="form-control @error('monitor') is-invalid @enderror"
                                name="monitor" id="inputMonitor" placeholder="Nama Monitor"
                                value="{{ old('monitor') }}">
                            @error('monitor')
                                <label for="inputNamaPengguna"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputkes" class="form-label">Jenis antivirus KES</label>
                            <input type="text" class="form-control @error('kes') is-invalid @enderror" name="kes"
                                id="inputkes" placeholder="Jenis antivirus KES" value="{{ old('kes') }}">
                            @error('kes')
                                <label for="inputNamaPengguna"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputMouse" class="form-label">Mouse</label>
                            <input type="text" class="form-control @error('mouse') is-invalid @enderror"
                                name="mouse" id="inputMouse" placeholder="Nama mouse" value="{{ old('mouse') }}">
                            @error('mouse')
                                <label for="inputNamaPengguna"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputKeyboard" class="form-label">Keyboard</label>
                            <input type="text" class="form-control @error('keyboard') is-invalid @enderror"
                                name="keyboard" id="inputKeyboard" placeholder="Nama keyboard"
                                value="{{ old('keyboard') }}">
                            @error('keyboard')
                                <label for="inputNamaPengguna"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="select-jd" class="form-label">Status Join Domain(JD)</label>
                            <select id="select-jd" name="status_id"
                                class="form-select @error('status_id') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Status --</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            @error('status_id')
                                <label for="select-jd" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputRental" class="form-label">Harga sewa</label>
                            <input type="text" class="form-control @error('rental_price') is-invalid @enderror"
                                name="rental_price" id="inputRental" placeholder="Harga sewa"
                                value="{{ old('rental_price') }}">
                            @error('rental_price')
                                <label for="inputNamaPengguna"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputKeyboard" class="form-label">Tanggal Kontrak</label>
                            <input type="date" class="form-control @error('contract_date') is-invalid @enderror"
                                name="contract_date" id="inputKeyboard" value="{{ old('contract_date') }}">
                            @error('contract_date')
                                <label for="inputNamaPengguna"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputBast" class="form-label">Bast</label>
                            <input type="file" name="bast" id="myDropify" />
                            @error('bast')
                                <label for="inputBast" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>



                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('computers.index') }}" class="btn btn-secondary" type="reset">Cancel</a>

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
            $("#select-brand").select2();
            $("#select-region").select2();
            $("#select-region-ownership").select2();
            $("#select-region-vendor").select2();
            $("#select-jd").select2();
        });
    </script>
@endpush
