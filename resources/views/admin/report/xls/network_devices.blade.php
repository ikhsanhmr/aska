<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Brand</th> 
            <th>Device Type</th>
            <th>IP Address</th>
            <th>Username</th>
            <th>Password</th>
            <th>Pengguna</th>
            <th>Nama Unit</th>
            <th>Status Aset</th>
            <th>Vendor</th>
            <th>Tahun</th>
        </tr>
    </thead>
    <tbody>
        @foreach($datas as $data)
        <tr>
            <td>{{ $loop->iteration }}</td> 
            <td>{{ $data->getDeviceBrands->name }}</td>
            <td>{{ $data->device_type }}</td>
            <td>{{ $data->ip_address }}</td>
            <td>{{ $data->user_name }}</td>
            <td>{{ $data->password }}</td>
            <td>{{ $data->username }}</td>
            <td>{{ $data->getUnits->nama_unit ?? 'Tidak ada' }}</td>
            <td>{{ $data->ownership_status}}</td>
            <td>{{ $data->getVendor->name ?? 'Tidak ada' }}</td>
            <td>{{ $data->year }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
