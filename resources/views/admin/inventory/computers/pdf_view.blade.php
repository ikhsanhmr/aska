<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Laporan Komputer</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 6px; font-size: 10px; text-align: left; }
        thead { background-color: #e0e0e0; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Seluruh Data Komputer</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Brand</th>
                <th>Computer Name</th>
                <th>Spesification</th>
                <th>User</th>
                <th>Serial Number</th>
                <th>IP Address</th>
                <th>Kantor Induk</th>
                <th>Unit</th>
                <th>Asset Status</th>
                <th>Vendor</th>
                <th>Year</th>
                <th>System Operation</th>
                <th>Office</th>
                <th>Status Join Domain</th>
                <th>Kes</th>
                <th>Mouse</th>
                <th>Keyboard</th>
                <th>Monitor</th>
                <th>Contract Date</th>
                <th>Rental Price</th>
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
                    <td>{{ $data->region->nama_region ?? 'Tidak ada' }}</td>
                    <td>{{ $data->getUnits->nama_unit ?? 'Tidak ada' }}</td>
                    <td>{{ $data->ownership_status }}</td>
                    <td>{{ $data->getVendor->bp_name ?? 'Tidak ada' }}</td>
                    <td>{{ $data->year }}</td>
                    <td>{{ $data->system_operation }}</td>
                    <td>{{ $data->office }}</td>
                    <td>{!! $data->status_id == 1 ? 'ya' : 'tidak' !!}</td>
                    <td>{{ $data->kes }}</td>
                    <td>{{ $data->mouse }}</td>
                    <td>{{ $data->keyboard }}</td>
                    <td>{{ $data->monitor }}</td>
                    <td>{{ $data->contract_date }}</td>
                    <td>{{ $data->rental_price }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="21" style="text-align: center;">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
