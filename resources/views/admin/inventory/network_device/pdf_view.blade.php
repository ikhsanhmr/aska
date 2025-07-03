<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Network Device</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 6px; font-size: 9px; text-align: left; }
        thead { background-color: #e0e0e0; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Data Network Device</h2>
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
            @forelse($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->getDeviceBrands->name ?? 'N/A' }}</td>
                    <td>{{ $data->device_type }}</td>
                    <td>{{ $data->ip_address }}</td>
                    <td>{{ $data->user_name }}</td>
                    <td>{{ $data->password }}</td>
                    <td>{{ $data->username }}</td>
                    <td>{{ $data->getUnits->nama_unit ?? 'Tidak ada' }}</td>
                    <td>{{ $data->ownership_status}}</td>
                    <td>{{ $data->getVendor->bp_name ?? 'Aset PLN' }}</td>
                    <td>{{ $data->year }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" style="text-align: center;">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>