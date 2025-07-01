<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Brand</th>
            <th>Pengguna</th>
            <th>Unit</th>
            <th>Asset Status</th>
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
            <td>{{ $data->vendor }}</td>
            <td>{{ $data->year }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
