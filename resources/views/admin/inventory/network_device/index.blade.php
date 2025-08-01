@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Inventory (Network Device)</li>
    </ol>
</nav>

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Data Network Device</h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
        {{-- Tombol Tambah Data --}}
        <a href="{{route('network-devices.create')}}" class="btn btn-info btn-icon-text mb-2 mb-md-0 me-2">
            <i class="btn-icon-prepend" data-feather="plus"></i>
            Tambah Data
        </a>
        {{-- Tombol Export Excel --}}
        <a href="{{ route('network-devices.export.excel', request()->query()) }}" class="btn btn-success btn-icon-text mb-2 mb-md-0 me-2">
            <i class="btn-icon-prepend" data-feather="file-text"></i>
            Export Excel
        </a>
        {{-- Tombol Export PDF --}}
        <a href="{{ route('network-devices.export.pdf', request()->query()) }}" class="btn btn-danger btn-icon-text mb-2 mb-md-0">
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
                <!-- <h6 class="card-title">Filter Data Network Device</h6>
                {{-- FORM FILTER --}}
                <form action="{{ route('network-devices.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="kd_region" class="form-label">Filter Berdasarkan Unit</label>
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
                                <a href="{{ route('network-devices.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </div>
                </form> -->
                <hr>
                <h6 class="card-title">Data Tabel Network Device</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Brand</th>
                                <th>Device Type</th>
                                <th>IP Address</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Pengguna</th>
                                <th>Nama Unit</th>
                                <th>Status Aset</th>
                                <th>Vendor</th>
                                <th>Tahun</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->getDeviceBrands->name ?? 'N/A' }}</td>
                                    <td>{{ $data->device_type }}</td>
                                    <td>{{ $data->ip_address }}</td>
                                    <td>{{ $data->user_name }}</td>
                                    <td>{{ $data->password }}</td>
                                    <td>{{ $data->username }}</td>
                                    <td>{{ $data->getUnits->nama_unit ?? 'Tidak ada' }}</td>
                                    <td>{{ $data->ownership_status}}</td>
                                    <td>{{ $data->getVendor->bp_name ?? 'Aset PLN' }}</td>
                                    <td>{{ $data->year }}</td>
                                    <td>
                                        <a href="{{ route('network-devices.edit', ['network_device' => $data]) }}" class="btn btn-sm btn-primary btn-icon">
                                            <i data-feather="edit"></i>
                                        </a>
                                        <form action="{{ route('network-devices.destroy', ['network_device'=> $data]) }}" style='display:inline;' method="POST" class="me-2">
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
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script>
        $(function() {
            'use strict';
            if ($(".select2").length) {
                $(".select2").select2();
            }
        });
    </script>
@endpush
