@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('deviceinterference.index') }}">Master Data (Kategori Gangguan Perangkat)</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tambah Kategori Gangguan Perangkat</h6>
                    <form class="forms-sample" action="{{ route('deviceinterference.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="inputName" placeholder="name" value="{{ old('name') }}">
                            @error('name')
                                <label for="inputName" class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('deviceinterference.index') }}" class="btn btn-secondary" type="reset">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


 
