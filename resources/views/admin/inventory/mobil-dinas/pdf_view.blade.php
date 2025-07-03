<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Mobil Dinas</title>
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
    <h2>Laporan Data Mobil Dinas</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Nomor Polisi</th>
                <th>Nomor Rangka</th>
                <th>Nomor Mesin</th>
                <th>Tahun Pembuatan</th>
                <th>Warna</th>
                <th>Unit</th>
                <th>Status Asset</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->brand->name }}</td>
                <td>{{ $data->model }}</td>
                <td>{{ $data->nomor_polisi }}</td>
                <td>{{ $data->nomor_rangka }}</td>
                <td>{{ $data->nomor_mesin }}</td>
                <td>{{ $data->tahun_pembuatan }}</td>
                <td>{{ $data->warna }}</td>
                <td>{{ $data->region->nama_region ?? 'Tidak ada' }}</td>
                <td>{{ $data->status_asset }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
