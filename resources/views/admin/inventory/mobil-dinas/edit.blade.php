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
            <li class="breadcrumb-item"><a href="{{ route('mobil-dinas.index') }}">Inventory (Mobil Dinas)</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah</li>
        </ol>
    </nav>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tambah Mobil Dinas</h6>
                    <form class="forms-sample" action="{{ route('mobil-dinas.update', ['mobil_dina' => $mobilDinas->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="select-region" class="form-label">Merk Mobil Dinas</label>
                            <select id="select-region" name="brand_id"
                                class="form-select @error('brand_id') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Merek --</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('id', $brand->id) == $mobilDinas->brand_id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <label for="select-region" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input_nomor_polisi" class="form-label">Nomor Polisi</label>
                            <input type="text" class="form-control @error('nomor_polisi') is-invalid @enderror"
                                name="nomor_polisi" id="input_nomor_polisi" placeholder="Nomor Polisi"
                                value="{{ old('nomor_polisi', $mobilDinas->nomor_polisi) }}">
                            @error('nomor_polisi')
                                <label for="input_nomor_polisi" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input_nomor_rangka" class="form-label">Nomor Rangka</label>
                            <input type="text" class="form-control @error('nomor_rangka') is-invalid @enderror"
                                name="nomor_rangka" id="input_nomor_rangka" placeholder="Nomor Rangka"
                                value="{{ old('nomor_rangka', $mobilDinas->nomor_rangka) }}">
                            @error('nomor_rangka')
                                <label for="input_nomor_rangka" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input_nomor_mesin" class="form-label">Nomor Mesin</label>
                            <input type="text" class="form-control @error('nomor_mesin') is-invalid @enderror"
                                name="nomor_mesin" id="input_nomor_mesin" placeholder="Nomor Mesin"
                                value="{{ old('nomor_mesin', $mobilDinas->nomor_mesin) }}">
                            @error('nomor_mesin')
                                <label for="input_nomor_mesin" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputModel" class="form-label">Model</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" name="model"
                                id="inputModel" placeholder="Serial Number" value="{{ old('model', $mobilDinas->model) }}">
                            @error('model')
                                <label for="inputModel" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="input_tahun_pembuatan" class="form-label">Tahun Pembuatan</label>
                            <input type="text" class="form-control @error('tahun_pembuatan') is-invalid @enderror"
                                name="tahun_pembuatan" id="input_tahun_pembuatan" placeholder="Tahun Pembuatan"
                                value="{{ old('tahun_pembuatan', $mobilDinas->tahun_pembuatan) }}">
                            @error('tahun_pembuatan')
                                <label for="input_tahun_pembuatan" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input_warna" class="form-label">warna</label>
                            <input type="text" class="form-control @error('warna') is-invalid @enderror"
                                name="warna" id="input_warna" placeholder="warna"
                                value="{{ old('warna', $mobilDinas->warna) }}">
                            @error('warna')
                                <label for="input_warna" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>




                        <div class="mb-3">
                            <label for="select-region" class="form-label">Kantor Induk</label>
                            <select id="select-region" name="kd_region"
                                class="form-select @error('kd_region') is-invalid @enderror" data-width="100%">
                                <option value="">-- Pilih Kantor --</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->kd_region }}" @selected($region->kd_region == $mobilDinas->kd_region)>
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
                                <option value="Aset PLN" {{ $mobilDinas->status_asset === 'Aset PLN' ? 'selected' : '' }}>
                                    Aset PLN</option>
                                <option value="Sewa" {{ $mobilDinas->status_asset === 'Sewa' ? 'selected' : '' }}>Sewa
                                </option>
                            </select>
                            @error('status_asset')
                                <label for="select-region" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="InputKeterangan" class="form-label">Keterangan</label>
                            <textarea type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                id="InputKeterangan" placeholder="" rows="3">{{ old('keterangan', $mobilDinas->keterangan) }}</textarea>
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
                        <a href="{{ route('mobil-dinas.index') }}" class="btn btn-secondary" type="reset">Cancel</a>

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
