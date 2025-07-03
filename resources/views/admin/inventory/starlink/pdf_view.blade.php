<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Starlink</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 6px; font-size: 10px; text-align: left; }
        thead { background-color: #e0e0e0; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Data Starlink</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Model</th>
                <th>Nomor Seri</th>
                <th>Unit</th>
                <th>Tanggal Pemasangan</th>
                <th>Status Asset</th>
            </tr>
        </thead>
        <tbody>
            @forelse($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->model }}</td>
                    <td>{{ $data->nomor_seri }}</td>
                    <td>{{ $data->region->nama_region ?? 'Tidak ada' }}</td>
                    <td>{{ $data->tanggal_pemasangan }}</td>
                    <td>{{ $data->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>