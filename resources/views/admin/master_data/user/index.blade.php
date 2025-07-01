@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users (Master Data)</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Data Users</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="javascript:;" class="btn btn-success btn-icon-text mb-2 mb-md-0 me-2" id="syncDataButton">
                <i class="btn-icon-prepend" data-feather="refresh-cw"></i>
                Sync HRIS
            </a>
            <a href="{{ url('users/create') }}" class="btn btn-info btn-icon-text mb-2 mb-md-0">
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
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>UP</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->nip }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->region->nama_region }}</td>
                                        <td>
                                            <a href="{{ route('users.show', $item->id) }}"
                                                class="btn btn-sm btn-success btn-icon">
                                                <i data-feather="eye"></i>
                                            </a>
                                            <a href="{{ route('users.edit', $item->id) }}"
                                                class="btn btn-sm btn-primary btn-icon">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <form action="{{ route('users.destroy', $item->id) }}" style='display:inline;'
                                                method="POST" class="me-2" style="cursor:pointer;">
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
    <script>
        $(function() {
            $('#syncDataButton').on('click', function() {
                if (confirm('Are you sure you want to sync data?')) {
                    var button = $(this);
                    button.prop('disabled', true).text('Syncing...'); // Disable and change text

                    $.ajax({
                        url: "{{ route('users.sync') }}", // Route to sync data
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            alert('Data synced successfully.');
                            button.prop('disabled', false).text(
                                'Sync Data'); // Re-enable button
                        },
                        error: function(xhr) {
                            alert('Failed to sync data.');
                            button.prop('disabled', false).text(
                                'Sync Data'); // Re-enable button
                        }
                    });
                }
            });
        })
    </script>
@endpush
