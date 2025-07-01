@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('network-contract-icon.index') }}">Master Data (Kontrak Jaringan
                    Icon+)</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tambah Kontrak Jaringan Icon+</h6>
                    <form class="forms-sample" action="{{ route('network-contract-icon.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="activation_date" class="form-label">Tanggal</label>
                            <input type="date" class="form-control @error('activation_date') is-invalid @enderror"
                                name="activation_date" id="activation_date" value="{{ old('activation_date') }}">
                            @error('activation_date')
                                <label for="activation_date" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="service_id" class="form-label">ID Service</label>
                            <input type="text" class="form-control @error('service_id') is-invalid @enderror"
                                name="service_id" id="service_id" placeholder="ID Service" value="{{ old('service_id') }}">
                            @error('service_id')
                                <label for="service_id" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="service" class="form-label">Service</label>
                            <select id="service" name="service" class="form-select @error('service') is-invalid @enderror"
                                data-width="100%">
                                <option value="" disabled selected>Pilih Service</option>
                                <option value="IPVPN" {{ old('service') == 'IPVPN' ? 'selected' : '' }}>
                                    IPVPN</option>
                                <option value="Metronet" {{ old('service') == 'Metronet' ? 'selected' : '' }}>
                                    Metronet</option>
                                <option value="VSAT IP" {{ old('service') == 'VSAT IP' ? 'selected' : '' }}>
                                    VSAT IP</option>
                                <option value="Clear Channel" {{ old('service') == 'Clear Channel' ? 'selected' : '' }}>
                                    Clear Channel</option>
                                <option value="Internet" {{ old('service') == 'Internet' ? 'selected' : '' }}>
                                    Internet</option>
                            </select>
                            @error('service')
                                <label for="service" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="asman" class="form-label">Asman</label>
                            <select id="asman" name="asman"
                                class="form-select @error('asman') is-invalid @enderror" data-width="100%">
                                <option value="" disabled selected>Pilih asman</option>
                                <option value="Asman Sumut 1" {{ old('asman') == 'Asman Sumut 1' ? 'selected' : '' }}>
                                    Asman Sumut 1</option>
                                <option value="Asman Sumut 2" {{ old('asman') == 'Asman Sumut 2' ? 'selected' : '' }}>
                                    Asman Sumut 2
                                </option>
                            </select>
                            @error('asman')
                                <label for="asman" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>                        

                        <div class="mb-3">
                            <label for="unit_id" class="form-label">Pilih Unit</label>
                            <select id="unit_id" name="unit_id" class="form-select @error('unit_id') is-invalid @enderror"
                                data-width="100%">
                                <option value="" disabled selected>Pilih Unit</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}"
                                        {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->nama_unit }}
                                    </option>
                                @endforeach
                            </select>
                            @error('unit_id')
                                <label for="unit_id" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="explanation" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('explanation') is-invalid @enderror" name="explanation" id="explanation"
                                placeholder="Keterangan">{{ old('explanation') }}</textarea>
                            @error('explanation')
                                <label for="explanation" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="activation_number" class="form-label">No BA Aktivasi/ADM</label>
                            <input type="text" class="form-control @error('activation_number') is-invalid @enderror"
                                name="activation_number" id="activation_number" placeholder="No BA Aktivasi/ADM"
                                value="{{ old('activation_number') }}">
                            @error('activation_number')
                                <label for="activation_number" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="scada" class="form-label">Scada/Non Scada</label>
                            <select id="scada" name="scada" class="form-select @error('scada') is-invalid @enderror"
                                data-width="100%">
                                <option value="" disabled selected>Pilih Scada/Non Scada</option>
                                <option value="Scada" {{ old('scada') == 'Scada' ? 'selected' : '' }}>
                                    Scada</option>
                                <option value="Non Scada" {{ old('scada') == 'Non Scada' ? 'selected' : '' }}>Non Scada
                                </option>
                            </select>
                            @error('scada')
                                <label for="scada" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="capacity" class="form-label">Kapasitas/BW</label>
                            <input type="text" class="form-control @error('capacity') is-invalid @enderror"
                                name="capacity" id="capacity" placeholder="Kapasitas/BW"
                                value="{{ old('capacity') }}">
                            @error('capacity')
                                <label for="capacity" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                name="price" id="price" placeholder="Harga" value="{{ old('price') }}">
                            @error('price')
                                <label for="price" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status"
                                class="form-select @error('status') is-invalid @enderror" data-width="100%">
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="Activate" {{ old('status') == 'Activate' ? 'selected' : '' }}>
                                    Activate</option>
                                <option value="Deactivated" {{ old('status') == 'Deactivated' ? 'selected' : '' }}>
                                    Deactivated
                                </option>
                            </select>
                            @error('status')
                                <label for="status" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="month" class="form-label">Bulan</label>
                            <select id="month" name="month"
                                class="form-select @error('month') is-invalid @enderror" data-width="100%">
                                <option value="" disabled selected>Pilih Bulan</option>
                                <option value="Januari" {{ old('month') == 'Januari' ? 'selected' : '' }}>
                                    Januari</option>
                                <option value="Februari" {{ old('month') == 'Februari' ? 'selected' : '' }}>
                                    Februari</option>
                                <option value="Maret" {{ old('month') == 'Maret' ? 'selected' : '' }}>
                                    Maret</option>
                                <option value="April" {{ old('month') == 'April' ? 'selected' : '' }}>
                                    April</option>
                                <option value="Mei" {{ old('month') == 'Mei' ? 'selected' : '' }}>
                                    Mei</option>
                                <option value="Juni" {{ old('month') == 'Juni' ? 'selected' : '' }}>
                                    Juni</option>
                                <option value="Juli" {{ old('month') == 'Juli' ? 'selected' : '' }}>
                                    Juli</option>
                                <option value="Agustus" {{ old('month') == 'Agustus' ? 'selected' : '' }}>
                                    Agustus</option>
                                <option value="September" {{ old('month') == 'September' ? 'selected' : '' }}>
                                    September</option>
                                <option value="Oktober" {{ old('month') == 'Oktober' ? 'selected' : '' }}>
                                    Oktober</option>
                                <option value="November" {{ old('month') == 'November' ? 'selected' : '' }}>
                                    November</option>
                                <option value="Desember" {{ old('month') == 'Desember' ? 'selected' : '' }}>
                                    Desember</option>
                            </select>
                            @error('month')
                                <label for="month" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">Tahun</label>
                            <select id="year" name="year"
                                class="form-select @error('year') is-invalid @enderror" data-width="100%">
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
                        <a href="{{ route('network-contract-icon.index') }}" class="btn btn-secondary"
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
            $("#status").select2();
            $("#service").select2();
            $("#unit_id").select2();
            $("#scada").select2();
            $("#month").select2();
            $("#year").select2();
            $("#asman").select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#price').on('input', function() {
                $(this).val(function(index, value) {
                    return value.replace(/[^\d.]/g, '');
                });
            });
            $('#service_id').on('input', function() {
                $(this).val(function(index, value) {
                    return value.replace(/[^\d.]/g, '');
                });
            });
        });
    </script>
@endpush
