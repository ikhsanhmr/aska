@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Unit (Master Data)</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Data Unit</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ url('unit/create') }}" class="btn btn-info btn-icon-text mb-2 mb-md-0">
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
                    <h6 class="card-title">Data User</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>KD Region</th>
                                    <th>KD Area</th>
                                    <th>KD Unit</th>
                                    <th>Nama Unit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $units)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $units->kd_region }}</td>
                                        <td>{{ $units->kd_area }}</td>
                                        <td>{{ $units->kd_unit }}</td>
                                        <td>{{ $units->nama_unit }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('unit.edit', $units->id) }}"
                                                class="btn btn-primary btn-xs">Edit</a>
                                            <form action="{{ route('unit.destroy', $units->id) }}" method="POST"
                                                class="me-2" style="cursor:pointer;">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-xs"
                                                    style="color: #fff;">Hapus</button>

                                            </form>
                                        </td>
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
