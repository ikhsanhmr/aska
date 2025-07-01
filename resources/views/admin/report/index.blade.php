@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Reports</li>
    </ol>
</nav>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Report Data</h4>
    </div>
</div>
@include('components.alert')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Report Data</h6>
                
                <form id="reportForm" method="post"> <!-- Ganti form tag -->
                    @csrf <!-- Sertakan token CSRF -->
                    
                    <div class="mb-3">
                        <label class="form-label">Pilih Jenis Inventory</label>
                        <select class="form-select" name="jenis" id="jenis" data-width="100%" required>
                            <option value="">-- Pilih Jenis Inventory --</option>
                            <option value="laptops">Laptop</option>
                            <option value="computers">Komputer</option>
                            <option value="printers">Printer</option>
                            <option value="monitors">Monitor</option>
                            <option value="servers">Server</option>
                            <option value="network_devices">Network Device</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="select-region" class="form-label">Kantor Unit</label>
                        <select id="unit_id" name="unit_id" class="form-select @error('unit_id') is-invalid @enderror" data-width="100%">
                            <option value="">-- Pilih Unit --</option> 
                            @foreach ($datas as $unit)
                            <option value="{{ $unit->id }}">{{ 'Nama unit: ' . $unit->nama_unit . ' Kode unit: ' . $unit->kd_unit }}</option>
                            @endforeach
                        </select>
                        @error('unit_id')
                        <label for="select-region" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Pilih Status</label>
                        <select class="form-select" name="status" id="status" data-width="100%">
                            <option value="">-- Pilih Status --</option>
                            <option value="Aset PLN">Aset PLN</option>
                            <option value="Sewa">Sewa</option>
                        </select>
                    </div>
                    
                    <button type="button" data-action="pdf" class="btn btn-danger me-2">Cetak PDF</button>
                    <button type="button" data-action="xls" class="btn btn-success">Cetak XLS</button>
                </form> <!-- Akhiri form tag -->
                
            </div>
        </div>
    </div>
</div>


@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
<script type="text/javascript">
   // Tangkap tombol-tombol dengan atribut data
const buttons = document.querySelectorAll('[data-action]');

// Tambahkan event listener ke masing-masing tombol
buttons.forEach(button => {
    button.addEventListener('click', function() {

        const action = button.getAttribute('data-action');
        const jenis = $('#jenis').val();
        const unit_id = $('#unit_id').val();
        const status = $('#status').val();

        // Tentukan URL berdasarkan tindakan
        const url = action === 'pdf' ? '/cetak-laporan-pdf' : '/cetak-laporan-xls';

        // Buat URL dengan parameter yang sesuai
        const downloadUrl = `${url}?jenis=${jenis}&unit_id=${unit_id}&status=${status}`;

        // Arahkan pengguna ke URL untuk mengunduh PDF
        window.location.href = downloadUrl;
    });
});

</script>

@endpush
