@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@push('form-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#vendor_id_container').hide();
            $('#ownership_status').on('change', function() {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                if (valueSelected == 'Sewa') {
                    $("#vendor_id_container").show();
                } else {
                    $("#vendor_id_container").hide();
                }
            });
        });
    </script>
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('network-devices.index') }}">Inventory (Network Device)</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tambah Network Device</h6>
                    <form class="forms-sample" action="{{ route('network-devices.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="brand_id" class="form-label">Merk Network Device</label>
                            <select id="brand_id" name="brand_id"
                                class="form-select @error('brand_id') is-invalid @enderror" data-width="100%">
                                <option value="" disabled selected>Pilih Merk Network Device</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <label for="brand_id" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="device_type" class="form-label">Device Type</label>
                            <input type="text" class="form-control @error('device_type') is-invalid @enderror"
                                name="device_type" id="device_type" placeholder="Device Type"
                                value="{{ old('device_type') }}">
                            @error('device_type')
                                <label for="device_type" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ip_address" class="form-label">IP Address</label>
                            <input type="text" class="form-control @error('ip_address') is-invalid @enderror"
                                name="ip_address" id="ip_address" placeholder="IP Adress" value="{{ old('ip_address') }}">
                            @error('ip_address')
                                <label for="ip_address" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="user_name" class="form-label">Username</label>
                            <input type="text" class="form-control @error('user_name') is-invalid @enderror"
                                name="user_name" id="user_name" placeholder="Username" value="{{ old('user_name') }}">
                            @error('user_name')
                                <label for="user_name" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="Password" value="{{ old('password') }}">
                            @error('password')
                                <label for="password" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Nama Pengguna</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" id="username" placeholder="Nama Pengguna" value="{{ old('username') }}">
                            @error('username')
                                <label for="username" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="unit_id" class="form-label">Pilih Unit</label>
                            <select id="unit_id" name="unit_id" class="form-select @error('unit_id') is-invalid @enderror"
                                data-width="100%">
                                <option value="" disabled selected>Pilih Unit</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}"
                                        {{ old('unit_id') == $unit->id ? 'selected' : '' }}>{{ $unit->nama_unit }}
                                    </option>
                                @endforeach
                            </select>
                            @error('unit_id')
                                <label for="unit_id" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ownership_status" class="form-label">Status Asset</label>
                            <select id="ownership_status" name="ownership_status"
                                class="form-select @error('ownership_status') is-invalid @enderror" data-width="100%">
                                <option value="" disabled selected>Pilih Status Asset</option>
                                <option value="Aset PLN" {{ old('ownership_status') == 'Aset PLN' ? 'selected' : '' }}>
                                    Aset PLN</option>
                                <option value="Sewa" {{ old('ownership_status') == 'Sewa' ? 'selected' : '' }}>Sewa
                                </option>
                            </select>
                            @error('ownership_status')
                                <label for="ownership_status"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3" id="vendor_id_container">
                            <label for="vendor_id" class="form-label">Vendor</label>
                            <select id="vendor_id" name="vendor_id"
                                class="form-select @error('vendor_id') is-invalid @enderror" data-width="100%">
                                <option value="" disabled selected>Pilih Vendor</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}"
                                        {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vendor_id')
                                <label for="vendor_id" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">Tahun</label>
                            <select id="year" name="year" class="form-select @error('year') is-invalid @enderror"
                                data-width="100%">
                                <option value="" disabled selected>Pilih Tahun</option>
                                @for ($i = date('Y'); $i <= 2030; $i++)
                                    <option value="{{ $i }}" {{ old('year') == $i ? 'selected' : '' }}>
                                        {{ $i }}</option>
                                @endfor
                            </select>
                            @error('year')
                                <label for="year" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('network-devices.index') }}" class="btn btn-secondary"
                            type="reset">Cancel</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush

@push('custom-scripts')
    <script>
        $(function() {
            $("#unit_id").select2();
            $("#brand_id").select2();
            $("#year").select2();
            $("#vendor_id").select2();
            $("#ownership_status").select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#ip_address').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^0-9.]/g, '');
                $(this).val(sanitizedValue);
            });
        });
    </script>
@endpush
