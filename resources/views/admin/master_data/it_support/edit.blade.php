@extends('layout.master')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/support') }}">IT Support</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Edit Data IT Support</h6>
                    <form class="forms-sample" action="{{ route('support.update', ['support' => $support]) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="input_name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="input_name"
                            name="name" value="{{ old('name', $support->name) }}" autocomplete="off"
                            placeholder="Nama Merek Perangkat">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                       
                        <div class="mb-3">
                            <label for="input_email" class="form-label">Email </label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                id="input_email" name="email" value="{{ old('email', $support->email) }}" placeholder="Email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input_handphone" class="form-label">Handphone</label>
                            <input  type="number" class="form-control @error('handphone') is-invalid @enderror"
                                id="input_handphone" name="handphone" value="{{ old('handphone', $support->handphone) }}" placeholder="Handphone">
                            @error('handphone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input_location" class="form-label">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror"
                                id="input_location" name="location" value="{{ old('location', $support->location) }}" placeholder="Lokasi">
                            @error('location')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ url('/support') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
