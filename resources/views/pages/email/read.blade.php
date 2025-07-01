@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Tables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Table</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Data Table</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>KD Region</th>
                                    <th>KD Area</th>
                                    <th>KD Unit</th>
                                    <th>Nama Unit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($masteru as $masterunits)
                                    <tr>                                      
                                        <td class="text-center">{{ $masterunits->id }}</td>
                                        <td class="text-center">{{ $masterunits->kd_region }}</td>
                                        <td class="text-center">{{ $masterunits->kd_area }}</td>
                                        <td class="text-center">{{ $masterunits->kd_unit }}</td>
                                        <td class="text-center">{{ $masterunits->nama_unit }}</td>
                                    </tr>
                                @endforeach --}}
                                <td class="text-left">1</td>
                                <td class="text-left">123</td>
                                <td class="text-left">kalimantan</td>
                                <td class="text-left">tratir</td>
                                <td class="text-left">mobil</td>
                                <td class="text-left"><a href="" class="btn btn-warning"><i
                                            class="fas fa-edit"></i>Edit</a>
                                    <form action="" method="POST" class="d-inline">
                                        <button type="submit"
                                            onclick="return confirm('Anda yakin ingin menghapus fungsi ini ?')"
                                            class="btn btn-danger">Hapus<i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
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
