@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('popicon.index') }}">Master Data (Pop Icon)</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
    </ol>
</nav>
@include('components.alert')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Tambah Pop Icon</h6>
                <form class="forms-sample" action="{{ route('popicon.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="select-region" class="form-label">Service</label>
                        <select id="multiple-select" multiple="multiple" name="service_id[]" class="form-select @error('service_id') is-invalid @enderror" data-width="100%"  >                        
                            <option value="">-- Pilih Service --</option>
                            @foreach ($networks as $network)
                            <option value="{{ $network->service_id }}" {{old('service_id') == $network->service_id ? 'selected' : ''}}>{{$network->service}}</option>
                            @endforeach
                        </select>
                        @foreach ($errors->get('service_id.*') as $message )
                            @foreach ($message as $item)
                            <label for="select-region" class="error mt-1 tx-13 text-danger">{{ $item }}</label>
                            @endforeach
                        @endforeach
                        @error('service_id')
                        <label for="select-region" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="inputPopName" class="form-label">Nama Pop Icon</label>
                        <input type="text" class="form-control @error('pop_icon_name') is-invalid @enderror"
                        name="pop_icon_name" id="inputPopName" placeholder="Nama Pop Icon" value="{{ old('pop_icon_name') }}">
                        @error('pop_icon_name')
                        <label for="inputPopName" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    
                    
                    <div class="mb-3">
                        <label for="inputNameLocation" class="form-label">Nama Pop Location</label>
                        <input type="text" class="form-control @error('pop_icon_location') is-invalid @enderror"
                        name="pop_icon_location" id="inputNameLocation" placeholder="Nama Pop Location" value="{{ old('pop_icon_location') }}">
                        @error('pop_icon_location')
                        <label for="inputNameLocation" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="{{ route('popicon.index') }}" class="btn btn-secondary" type="reset">Cancel</a>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script>
    $(function() {
        $("#select-region").select2();
    });
</script>
<script>
    $(document).ready(function() {
        $('#multiple-select').select2();
    });
</script>
@endpush
