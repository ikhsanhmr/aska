@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Master Data (Stok Perangkat)</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Stok Perangkat</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">   
            <a href="{{route('device_stock.create')}}" class="btn btn-info btn-icon-text mb-2 mb-md-0">
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
                    <h6 class="card-title">Stok Perangkat</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Perangkat</th>
                                    <th>Jumlah Perangkat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dat as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->device_type }}</td>
                                        <td>{{ $data->number_of_devices }}</td>
                                        <td>
                                            
                                            <a href="{{route('device_stock.edit',['device_stock'=>$data])}}" class="btn btn-sm btn-primary btn-icon">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <form action="{{ route('device_stock.destroy', ['device_stock'=>$data]) }}" style='display:inline;'  method="POST"  class="me-2" style="cursor:pointer;">
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
