<!DOCTYPE html>
<html>
<head>
    <title>Laporan Printer</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h3 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h3>Laporan Data Printer</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Brand</th>
                <th>Pengguna</th>
                <th>Kantor Induk</th>
                <th>Status Asset</th>
                <th>Vendor</th>
                <th>Year</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->getDeviceBrands->name ?? 'N/A' }}</td>
                    <td>{{ $data->user_name }}</td>
                    <td>{{ $data->region->nama_region ?? 'Tidak ada' }}</td>
                    <td>{{ $data->ownership_status }}</td>
                    <td>{{ $data->vendor }}</td>
                    <td>{{ $data->year }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
