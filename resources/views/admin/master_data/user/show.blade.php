@extends('layout.master')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Master Data (User)</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Data</li>
        </ol>
    </nav>
    @include('components.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                            <a href="{{route('users.index')}}" class="btn btn-sm btn-warning btn-icon me-2">
                                <i data-feather="arrow-left"></i>
                            </a>
                            <h6 class="card-title mb-0">Detail Data User</h6>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item d-flex align-items-center" href="{{route('users.edit', ['user' => $user])}}">
                                    <i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <img class="img-fluid mb-3" style="width: 200px;" src="{{ $user->photo ? url(Storage::url($user->photo)) : asset('noimage/no-image.jpg') }}" alt="Photo User">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="tx-11 fw-bolder text-uppercase">Nama :</label>
                                <p>{{ $user->name }}</p>
                            </div>
                            <div class="form-group">
                                <label class="tx-11 fw-bolder text-uppercase">NIP :</label>
                                <p>{{ $user->nip }}</p>
                            </div>
                            <div class="form-group">
                                <label class="tx-11 fw-bolder text-uppercase">Username :</label>
                                <p>{{ $user->username }}</p>
                            </div>
                            <div class="form-group">
                                <label class="tx-11 fw-bolder text-uppercase">Email :</label>
                                <p>{{ $user->email }}</p>
                            </div>
                            <div class="form-group">
                                <label class="tx-11 fw-bolder text-uppercase">Phone :</label>
                                <p>{{ $user->phone }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="tx-11 fw-bolder text-uppercase">Address :</label>
                                <p>{{ $user->address }}</p>
                            </div>
                            <div class="form-group">
                                <label class="tx-11 fw-bolder text-uppercase">Birth Place :</label>
                                <p>{{ $user->birthplace }}</p>
                            </div>
                            <div class="form-group">
                                <label class="tx-11 fw-bolder text-uppercase">Birth Date :</label>
                                <p>{{ $user->birthdate }}</p>
                            </div>
                            <div class="form-group">
                                <label class="tx-11 fw-bolder text-uppercase">Position :</label>
                                <p>{{ $user->position }}</p>
                            </div>
                            <div class="form-group">
                                <label class="tx-11 fw-bolder text-uppercase">Region :</label>
                                <p>{{ $user->region->nama_region }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="tx-11 fw-bolder text-uppercase">Gender :</label>
                        <p>{{ $user->gender }}</p>
                    </div>
                    <div class="form-group">
                        <label class="tx-11 fw-bolder text-uppercase">Role :</label>
                        <p>{{ $user->role }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
