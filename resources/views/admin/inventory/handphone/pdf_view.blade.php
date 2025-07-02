<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Handphone</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 6px; text-align: left; }
        thead { background-color: #e0e0e0; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Data Handphone</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Serial Number</th>
                <th>Nama Pegawai</th>
                <th>Unit</th>
                <th>Status Asset</th>
            </tr>
        </thead>
        <tbody>
            @forelse($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->brand->name ?? 'N/A' }}</td>
                    <td>{{ $data->model }}</td>
                    <td>{{ $data->serial_number }}</td>
                    <td>{{ $data->nama_pegawai }}</td>
                    <td>{{ $data->region->nama_region ?? 'Tidak ada' }}</td>
                    <td>{{ $data->status_asset }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data yang dapat ditampilkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
