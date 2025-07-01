@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Master Data (Kontrak Jaringan Icon+)</li>
    </ol>
</nav>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Data Kontrak Jaringan Icon+</h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">   
        <a href="{{route('network-contract-icon.create')}}" class="btn btn-info btn-icon-text mb-2 mb-md-0">
            <i class="btn-icon-prepend" data-feather="plus"></i>
            Tambah Data
        </a>
    </div>
</div>
@include('components.alert')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Data Kontrak Jaringan Icon+</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Aktivasi</th> 
                                <th>ID Service</th>
                                <th>Service</th>
                                <th>Asman</th>
                                <th>Nama Unit</th>
                                <th>Keterangan</th>
                                <th>No. BA Aktivasi/ADM</th>
                                <th>Scada/Non Scada</th>
                                <th>Kapasitas/BW</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td> 
                                    <td>{{ date('d F Y', strtotime($data->activation_date)) }}</td>
                                    <td>{{ $data->service_id }}</td>
                                    <td>{{ $data->service }}</td>
                                    <td>{{ $data->asman }}</td>
                                    <td>{{ $data->getUnits->nama_unit ?? 'Tidak ada' }}</td>
                                    <td>{{ $data->explanation }}</td>
                                    <td>{{ $data->activation_number }}</td>
                                    <td>{{ $data->scada }}</td>
                                    <td>{{ $data->capacity }}</td>
                                    <td>Rp. {{ $data->price }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>{{ $data->month }}</td>
                                    <td>{{ $data->year }}</td>
                                    <td>
                                        <a href="{{ route('network-contract-icon.edit', ['network_contract_icon' => $data]) }}" class="btn btn-sm btn-primary btn-icon">
                                            <i data-feather="edit"></i>
                                        </a>
                                        <form action="{{ route('network-contract-icon.destroy', ['network_contract_icon'=> $data]) }}" style='display:inline;'  method="POST"  class="me-2" style="cursor:pointer;">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger btn-icon">
                                              <i data-feather="trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
@endpush