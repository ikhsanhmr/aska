@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Inventory (CCTV)</li>
    </ol>
</nav>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Data CCTV</h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
        <a href="{{route('cctv.create')}}" class="btn btn-info btn-icon-text mb-2 mb-md-0 me-2">
            <i class="btn-icon-prepend" data-feather="plus"></i>
            Tambah Data
        </a>
        {{-- Tombol Export Excel --}}
        <a href="{{ route('cctv.export.excel', request()->query()) }}" class="btn btn-success btn-icon-text mb-2 mb-md-0 me-2">
            <i class="btn-icon-prepend" data-feather="file-text"></i>
            Export Excel
        </a>
        {{-- Tombol Export PDF --}}
        <a href="{{ route('cctv.export.pdf', request()->query()) }}" class="btn btn-danger btn-icon-text mb-2 mb-md-0">
            <i class="btn-icon-prepend" data-feather="file"></i>
            Export PDF
        </a>
    </div>
</div>
@include('components.alert')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Data CCTV</h6>
                {{-- FORM FILTER --}}
                <form action="{{ route('cctv.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <select class="form-select select2" name="kd_region" id="kd_region">
                                    <option value="">-- Tampilkan Semua Unit --</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->kd_region }}" {{ request('kd_region') == $region->kd_region ? 'selected' : '' }}>
                                            {{ $region->nama_region }} ({{ $region->kd_region }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 align-self-end">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('cctv.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Brand</th>
                                <th>Nama</th>
                                <th>Model</th>
                                <th>Nomor Seri</th>
                                <th>Alamat IP</th>
                                <th>Unit</th>
                                <th>Status CCTV</th>
                                <th>Tanggal Instalasi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->brand->name }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->model }}</td>
                                    <td>{{ $data->nomor_seri }}</td>
                                    <td>{{ $data->alamat_ip }}</td>
                                    <td>{{ $data->region->nama_region ?? 'Tidak ada' }}</td>
                                    <td>{{ $data->tanggal_instalasi }}</td>
                                    <td>{{ $data->status_cctv }}</td>

                                    <td>
                                        <a href="{{ route('cctv.edit', ['cctv' => $data]) }}" class="btn btn-sm btn-primary btn-icon">
                                            <i data-feather="edit"></i>
                                        </a>
                                        <form action="{{ route('cctv.destroy', ['cctv'=> $data]) }}" style='display:inline;'  method="POST"  class="me-2" style="cursor:pointer;">
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
