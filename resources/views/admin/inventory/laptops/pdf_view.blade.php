{{-- File: resources/views/laptops/pdf_view.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Laporan Laptop</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 6px; font-size: 10px; text-align: left; }
        thead { background-color: #e0e0e0; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Seluruh Data Laptop</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Brand</th>
                <th>Laptop Name</th>
                <th>Spesification</th>
                <th>User</th>
                <th>Serial Number</th>
                <th>IP Address</th>
                <th>Unit</th>
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
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->spesification }}</td>
                    <td>{{ $data->user_name }}</td>
                    <td>{{ $data->serial_number }}</td>
                    <td>{{ $data->ip_address }}</td>
                    <td>{{ $data->getUnits->nama_unit ?? 'Tidak ada' }}</td>
                    <td>{{ $data->ownership_status }}</td>
                    <td>{{ $data->vendor }}</td>
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