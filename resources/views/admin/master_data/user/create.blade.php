@extends('layout.master')

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/users') }}">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Tambah Data User</h6>
                <form class="forms-sample" action="{{ url('users') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="input_name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="input_name" name="name"  value="{{ old('name') }}" autocomplete="off"
                            placeholder="Full Name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_nip" class="form-label">NIP</label>
                        <input type="text" class="form-control @error('nip') is-invalid @enderror" id="input_nip" name="nip" value="{{ old('nip') }}" placeholder="NIP">
                        @error('nip')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_username" class="form-label">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="input_username" name="username" value="{{ old('username') }}" placeholder="Username">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_password_confirmation" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="input_password" name="password" placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="input_password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="input_email" name="email" value="{{ old('email') }}" placeholder="Email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_phone" class="form-label">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="input_phone" name="phone" value="{{ old('phone') }}" placeholder="Phone">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_address" class="form-label">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="input_address" name="address" value="{{ old('address') }}" placeholder="Address">
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input class="form-control @error('photo') is-invalid @enderror" type="file" name="photo" name="photo" id="photo" />
                        @error('photo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_birthplace" class="form-label">Birth Place</label>
                        <input type="text" class="form-control @error('birthplace') is-invalid @enderror" id="input_birthplace" name="birthplace" value="{{ old('birthplace') }}" placeholder="Birth Place">
                        @error('birthplace')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_birthdate" class="form-label">Birth Date</label>
                        <input type="date" class="form-control @error('birthdate') is-invalid @enderror" id="input_birthdate" name="birthdate" value="{{ old('birthdate') }}" placeholder="Nama Region">
                        @error('birthdate')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_gender" class="form-label">Gender</label>
                        <select class="form-select @error('gender') is-invalid @enderror" id="input_gender" name="gender">
                            <option selected disabled>Select Gender</option>
                            <option value="L" @selected(old('gender') == 'L')>Laki-laki</option>
                            <option value="P" @selected(old('gender') == 'P')>Perempuan</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_position" class="form-label">Position</label>
                        <input type="text" class="form-control @error('position') is-invalid @enderror" id="input_position" name="position" placeholder="Position" value="{{ old('position') }}"/>
                        @error('position')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_kd_region" class="form-label">Region</label>
                        <select class="form-select @error('kd_region') is-invalid @enderror" id="input_kd_region" name="kd_region">
                            <option value="" selected disabled>Select Region</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region->kd_region }}" @selected(old('kd_region') == $region->kd_region)>{{ $region->nama_region }}</option>
                            @endforeach
                        </select>
                        @error('kd_region')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_role" class="form-label">Role</label>
                        <select class="form-select @error('role') is-invalid @enderror" id="input_role" name="role">
                            <option value="" selected disabled>Select Role</option>
                            <option value="admin" @selected(old('role') == 'admin')>Admin</option>
                            <option value="user" @selected(old('role') == 'user')>User</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="{{ url('/users') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-scripts')
    <script>
        $(function() {
            $("#input_unit").select2();
        });

        $(function() {
            $("#input_kd_region").select2();
        });
    </script>
@endpush
