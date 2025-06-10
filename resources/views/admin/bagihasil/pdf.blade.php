<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Bagi Hasil</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
    <h3>Laporan Bagi Hasil Peternak</h3>
    <p>Status: {{ $status ?? 'Semua' }}</p>
    <table>
        <thead>
            <tr>
                <th>Peternak</th>
                <th>Ternak</th>
                <th>Tanggal Lahir</th>
                <th>Tagihan</th>
                <th>Dibayar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $bagi)
            <tr>
                <td>{{ $bagi->user->nama ?? $bagi->user->name }}</td>
                <td>{{ $bagi->kegiatan->ternak->nama ?? '-' }}</td>
                <td>{{ $bagi->kegiatan->tgl_kegiatan }}</td>
                <td>Rp{{ number_format($bagi->total_tagihan) }}</td>
                <td>Rp{{ number_format($bagi->jumlah_dibayar) }}</td>
                <td>{{ ucfirst($bagi->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
