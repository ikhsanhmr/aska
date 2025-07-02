{{-- File: resources/views/admin/inventory/monitors/pdf_view.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Laporan Monitor</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 6px; font-size: 10px; text-align: left; }
        thead { background-color: #e0e0e0; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Seluruh Data Monitor</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Brand</th>
                <th>User</th>
                <th>Kantor Induk</th>
                <th>Status Asset</th>
                <th>Vendor</th>
                <th>Year</th>
            </tr>
        </thead>
        <tbody>
            @forelse($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->getDeviceBrands->name ?? 'N/A' }}</td>
                    <td>{{ $data->user_name }}</td>
                    <td>{{ $data->region->nama_region ?? 'Tidak ada' }}</td>
                    <td>{{ $data->ownership_status }}</td>
                    <td>{{ $data->vendor }}</td>
                    <td>{{ $data->year }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
