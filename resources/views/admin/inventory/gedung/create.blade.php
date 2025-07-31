@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('gedung.index') }}">Inventory (gedung)</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tambah gedung</h6>
                    <form class="forms-sample" action="{{ route('gedung.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- <div class="mb-3">
                            <label for="Input_nama" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                name="nama" id="input_nama" placeholder="Nama"
                                value="{{ old('nama') }}">
                            @error('nama')
                                <label for="Input_nama"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div> -->

                        <div class="mb-3">
                            <label for="Input_uraian" class="form-label">Uraian</label>
                            <textarea class="form-control @error('uraian') is-invalid @enderror" name="uraian"
                                id="Input_uraian" placeholder="Uraian" rows="3">{{ old('uraian') }}</textarea>
                            @error('uraian')
                                <label for="Input_uraian" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <!-- <div class="mb-3">
                            <label for="Input_alamat" class="form-label">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                id="Input_alamat" placeholder="Alamat" rows="3">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <label for="Input_alamat" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div> -->

                        <div class="mb-3">
                            <label for="select-kd-up" class="form-label">Unit Pelaksana (UP)</label>
                            <select id="select-kd-up" name="kd_up"
                                class="form-select @error('kd_up') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Unit Pelaksana --</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->kd_region }}" {{ old('kd_up') == $region->kd_region ? 'selected' : '' }}>
                                        {{ $region->nama_region }} ({{ $region->kd_region }})
                                    </option>
                                @endforeach
                            </select>
                            @error('kd_up')
                                <label for="select-kd-up"
                                    class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_unit_manual" class="form-label">Unit</label>
                            <input type="text" class="form-control @error('unit_manual') is-invalid @enderror"
                                name="unit_manual" id="Input_unit_manual" placeholder="Unit Manual"
                                value="{{ old('unit_manual') }}">
                            @error('unit_manual')
                                <label for="Input_unit_manual" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="select-pihak-pertama" class="form-label">Pihak Pertama</label>
                            <select id="select-pihak-pertama" name="pihak_pertama"
                                class="form-select @error('pihak_pertama') is-invalid @enderror" data-width="100%">
                                <option value="PT PLN Nusa Daya" selected>PT PLN Nusa Daya</option>
                            </select>
                            @error('pihak_pertama')
                                <label for="select-pihak-pertama" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_pihak_kedua" class="form-label">Pihak Kedua</label>
                            <input type="text" class="form-control @error('pihak_kedua') is-invalid @enderror"
                                name="pihak_kedua" id="Input_pihak_kedua" placeholder="Pihak Kedua"
                                value="{{ old('pihak_kedua') }}">
                            @error('pihak_kedua')
                                <label for="Input_pihak_kedua" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_alamat_kantor" class="form-label">Alamat Kantor</label>
                            <textarea class="form-control @error('alamat_kantor') is-invalid @enderror" name="alamat_kantor"
                                id="Input_alamat_kantor" placeholder="Alamat Kantor" rows="3">{{ old('alamat_kantor') }}</textarea>
                            @error('alamat_kantor')
                                <label for="Input_alamat_kantor" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_luas_tanah_m2" class="form-label">Luas Tanah (m²)</label>
                            <input type="number" step="0.01" class="form-control @error('luas_tanah_m2') is-invalid @enderror"
                                name="luas_tanah_m2" id="Input_luas_tanah_m2" placeholder="Luas Tanah dalam m²"
                                value="{{ old('luas_tanah_m2') }}">
                            @error('luas_tanah_m2')
                                <label for="Input_luas_tanah_m2" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_luas_bangunan_m2" class="form-label">Luas Bangunan (m²)</label>
                            <input type="number" step="0.01" class="form-control @error('luas_bangunan_m2') is-invalid @enderror"
                                name="luas_bangunan_m2" id="Input_luas_bangunan_m2" placeholder="Luas Bangunan dalam m²"
                                value="{{ old('luas_bangunan_m2') }}">
                            @error('luas_bangunan_m2')
                                <label for="Input_luas_bangunan_m2" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="select-asuransi-yn" class="form-label">Asuransi Y/N</label>
                            <select id="select-asuransi-yn" name="asuransi_yn"
                                class="form-select @error('asuransi_yn') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih --</option>
                                <option value="Y" {{ old('asuransi_yn') == 'Y' ? 'selected' : '' }}>Yes</option>
                                <option value="N" {{ old('asuransi_yn') == 'N' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('asuransi_yn')
                                <label for="select-asuransi-yn" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="select-status-sewa" class="form-label">Status Sewa</label>
                            <select id="select-status-sewa" name="status_sewa"
                                class="form-select @error('status_sewa') is-invalid @enderror" data-width="100%">
                                <option value="Sewa" selected>Sewa</option>
                            </select>
                            @error('status_sewa')
                                <label for="select-status-sewa" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_no_sertifikat" class="form-label">No. Sertifikat</label>
                            <input type="text" class="form-control @error('no_sertifikat') is-invalid @enderror"
                                name="no_sertifikat" id="Input_no_sertifikat" placeholder="Nomor Sertifikat"
                                value="{{ old('no_sertifikat') }}">
                            @error('no_sertifikat')
                                <label for="Input_no_sertifikat" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_nomor_pj" class="form-label">Nomor PJ</label>
                            <input type="text" class="form-control @error('nomor_pj') is-invalid @enderror"
                                name="nomor_pj" id="Input_nomor_pj" placeholder="Nomor PJ"
                                value="{{ old('nomor_pj') }}">
                            @error('nomor_pj')
                                <label for="Input_nomor_pj" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_tanggal_input" class="form-label">Tanggal Input</label>
                            <input type="date" class="form-control @error('tanggal_input') is-invalid @enderror"
                                name="tanggal_input" id="Input_tanggal_input" 
                                value="{{ old('tanggal_input') }}">
                            @error('tanggal_input')
                                <label for="Input_tanggal_input" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_periode_awal" class="form-label">Periode Awal</label>
                            <input type="date" class="form-control @error('periode_awal') is-invalid @enderror"
                                name="periode_awal" id="Input_periode_awal"
                                value="{{ old('periode_awal') }}">
                            @error('periode_awal')
                                <label for="Input_periode_awal" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_periode_akhir" class="form-label">Periode Akhir</label>
                            <input type="date" class="form-control @error('periode_akhir') is-invalid @enderror"
                                name="periode_akhir" id="Input_periode_akhir"
                                value="{{ old('periode_akhir') }}">
                            @error('periode_akhir')
                                <label for="Input_periode_akhir" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_awal_sewa" class="form-label">Awal Sewa</label>
                            <input type="date" class="form-control @error('awal_sewa') is-invalid @enderror"
                                name="awal_sewa" id="Input_awal_sewa"
                                value="{{ old('awal_sewa') }}">
                            @error('awal_sewa')
                                <label for="Input_awal_sewa" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_akhir_sewa" class="form-label">Akhir Sewa</label>
                            <input type="date" class="form-control @error('akhir_sewa') is-invalid @enderror"
                                name="akhir_sewa" id="Input_akhir_sewa"
                                value="{{ old('akhir_sewa') }}">
                            @error('akhir_sewa')
                                <label for="Input_akhir_sewa" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_tahun_sewa" class="form-label">Tahun Sewa (Bulan)</label>
                            <input type="number" class="form-control @error('tahun_sewa') is-invalid @enderror"
                                name="tahun_sewa" id="Input_tahun_sewa" placeholder="Contoh: 10"
                                value="{{ old('tahun_sewa') }}">
                            @error('tahun_sewa')
                                <label for="Input_tahun_sewa" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_nilai" class="form-label">Nilai</label>
                            <input type="number" step="0.01" class="form-control @error('nilai') is-invalid @enderror"
                                name="nilai" id="Input_nilai" placeholder="Nilai"
                                value="{{ old('nilai') }}">
                            @error('nilai')
                                <label for="Input_nilai" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                id="Input_keterangan" placeholder="Keterangan" rows="3">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <label for="Input_keterangan" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Input_validasi" class="form-label">Validasi</label>
                            <input type="text" class="form-control @error('validasi') is-invalid @enderror"
                                name="validasi" id="Input_validasi" placeholder="Validasi"
                                value="{{ old('validasi') }}">
                            @error('validasi')
                                <label for="Input_validasi" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputBast" class="form-label">BAST</label>
                            <input type="file" name="bast" id="myDropify" />
                            @error('bast')
                                <label for="inputBast" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('gedung.index') }}" class="btn btn-secondary" type="reset">Cancel</a>

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
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
@endpush
@push('custom-scripts')
    <script>
        $(function() {
            // Initialize Select2 for all select elements
            $("#select-kd-up").select2();
            $("#select-pihak-pertama").select2();
            $("#select-asuransi-yn").select2();
            $("#select-status-sewa").select2();

            // Initialize Dropify for file inputs
            $('#myDropify').dropify();

            // Initialize Flatpickr for date inputs
            flatpickr("#Input_tanggal_input", { dateFormat: "Y-m-d" });
            flatpickr("#Input_periode_awal", { dateFormat: "Y-m-d" });
            flatpickr("#Input_periode_akhir", { dateFormat: "Y-m-d" });
            flatpickr("#Input_awal_sewa", { dateFormat: "Y-m-d" });
            flatpickr("#Input_akhir_sewa", { dateFormat: "Y-m-d" });
        });
    </script>
@endpush
