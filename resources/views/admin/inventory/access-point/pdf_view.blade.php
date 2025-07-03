<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Access Point</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
            margin-top: 0;
        }
    </style>
</head>
<body>
    <h2>Laporan Data Access Point</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Access Point / WIFI</th>
                <th>Model</th>
                <th>Nomor Seri</th>
                <th>Mac Address</th>
                <th>Alamat IP</th>
                <th>Unit</th>
                <th>Status</th>
                <th>Status Asset</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->nama_ap }}</td>
                <td>{{ $data->model }}</td>
                <td>{{ $data->nomor_seri }}</td>
                <td>{{ $data->mac_address }}</td>
                <td>{{ $data->alamat_ip }}</td>
                <td>{{ $data->region->nama_region ?? 'Tidak ada' }}</td>
                <td>{{ $data->status }}</td>
                <td>{{ $data->status_asset }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
