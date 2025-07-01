<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Brand</th>
            <th>User</th>
            <th>Unit</th>
            <th>Status Asset</th>
            <th>Vendor</th>
            <th>Year</th>
        </tr>
    </thead>
    <tbody>
        @foreach($datas as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->getDeviceBrands->name }}</td>
            <td>{{ $data->user_name }}</td>
            <td>{{ $data->getUnits->nama_unit ?? 'Tidak ada' }}</td>
            <td>{{ $data->ownership_status }}</td>
            <td>{{ $data->getVendor->name ?? 'Tidak ada' }}</td>
            <td>{{ $data->year }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
