<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Gedung</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 6px; font-size: 8px; text-align: left; } /* Reduced font size for more columns */
        thead { background-color: #e0e0e0; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Data Gedung</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <!-- <th>Nama</th> -->
                <th>Uraian</th>
                <!-- <th>Alamat</th> -->
                <th>UP</th>
                <th>Unit</th>
                <th>Pihak Pertama</th>
                <th>Pihak Kedua</th>
                <th>Alamat Kantor</th>
                <th>Luas Tanah (m2)</th>
                <th>Luas Bangunan (m2)</th>
                <th>Asuransi Y/N</th>
                <th>Status Sewa</th>
                <th>No. Sertifikat</th>
                <th>Nomor PJ</th>
                <th>Tanggal Input</th>
                <th>Periode Awal</th>
                <th>Periode Akhir</th>
                <th>Awal Sewa</th>
                <th>Akhir Sewa</th>
                <th>Tahun Sewa (Bulan)</th>
                <th>Nilai</th>
                <th>Keterangan</th>
                <th>Validasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <!-- <td>{{ $data->nama }}</td> -->
                    <td>{{ $data->uraian }}</td>
                    <!-- <td>{{ $data->alamat }}</td> -->
                    <td>{{ $data->region->nama_region ?? 'Tidak ada' }}</td>
                    <td>{{ $data->unit_manual }}</td>
                    <td>{{ $data->pihak_pertama }}</td>
                    <td>{{ $data->pihak_kedua }}</td>
                    <td>{{ $data->alamat_kantor }}</td>
                    <td>{{ $data->luas_tanah_m2 }}</td>
                    <td>{{ $data->luas_bangunan_m2 }}</td>
                    <td>{{ $data->asuransi_yn }}</td>
                    <td>{{ $data->status_sewa }}</td>
                    <td>{{ $data->no_sertifikat }}</td>
                    <td>{{ $data->nomor_pj }}</td>
                    <td>{{ $data->tanggal_input ? \Carbon\Carbon::parse($data->tanggal_input)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $data->periode_awal ? \Carbon\Carbon::parse($data->periode_awal)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $data->periode_akhir ? \Carbon\Carbon::parse($data->periode_akhir)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $data->awal_sewa ? \Carbon\Carbon::parse($data->awal_sewa)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $data->akhir_sewa ? \Carbon\Carbon::parse($data->akhir_sewa)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $data->tahun_sewa }}</td>
                    <td>{{ number_format($data->nilai, 0, ',', '.') }}</td>
                    <td>{{ $data->keterangan }}</td>
                    <td>{{ $data->validasi }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="24" style="text-align: center;">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
