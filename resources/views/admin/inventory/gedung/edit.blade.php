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
            <li class="breadcrumb-item"><a href="{{ route('area.index') }}">Inventory (gedung)</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah</li>
        </ol>
    </nav>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Ubah gedung</h6>
                    <form class="forms-sample" action="{{ route('gedung.update', ['gedung' => $gedung]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="inputnama" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="inputnama" placeholder="Nama" value="{{ old('nama', $gedung->nama) }}">
                            @error('nama')
                                <label for="inputnama" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="InputAlamat" class="form-label">Alamat</label>
                            <textarea type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                id="InputAlamat" placeholder="Alamat gedung" rows="3">{{ old('alamat', $gedung->alamat) }}</textarea>
                            @error('alamat')
                                <label for="InputAlamat" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="select-region" class="form-label">Kantor Induk</label>
                            <select id="select-region" name="kd_region"
                                class="form-select @error('kd_region') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Kantor --</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->kd_region }}" @selected($region->kd_region == $gedung->kd_region)>
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
                            <select id="select-region-ownership" name="status_asset"
                                class="form-select @error('status_asset') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Status --</option>
                                <option value="Aset PLN" {{ $gedung->status_asset === 'Aset PLN' ? 'selected' : '' }}>
                                    Aset PLN</option>
                                <option value="Sewa" {{ $gedung->status_asset === 'Sewa' ? 'selected' : '' }}>Sewa
                                </option>
                            </select>
                            @error('status_asset')
                                <label for="select-region" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="InputKeterangan" class="form-label">Keterangan</label>
                            <textarea type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                id="InputKeterangan" placeholder="Spesifikasi gedung" rows="3">{{ old('keterangan', $gedung->keterangan) }}</textarea>
                            @error('keterangan')
                                <label for="InputKeterangan" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
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
