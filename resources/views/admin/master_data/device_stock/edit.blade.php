@extends('layout.master')




@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('device_stock.index') }}">Stok Perangkat</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Edit Data Stok Perangkat</h6>
                    <form class="forms-sample" action="{{ route('device_stock.update', $device_stock->id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="device_type" class="form-label">Jenis Perangkat</label>
                            <select id="device_type" name="device_type"
                                class="form-select @error('device_type') is-invalid @enderror" data-width="100%">
                                <option value="{{ $device_stock->device_type }}">{{ $device_stock->device_type }}</option>
                                @foreach ($options as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>
                            @error('device_type')
                                <label for="device_type" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="number_of_devices" class="form-label">Jumlah Perangkat </label>
                            <input type="text" class="form-control @error('number_of_devices') is-invalid @enderror"
                                id="number_of_devices" name="number_of_devices"
                                value="{{ $device_stock->number_of_devices }}" placeholder="Jumlah Perangkat">
                            @error('number_of_devices')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('device_stock.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script>
        $(function() {
            $("#device_type").select2();
        });
    </script>
@endpush
