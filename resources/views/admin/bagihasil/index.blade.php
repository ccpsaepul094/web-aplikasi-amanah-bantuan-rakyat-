@extends('admin.layouts.master')

@section('content')
<h2>Data Bagi Hasil Peternak</h2>

<form method="GET" action="{{ route('admin.bagihasil.index') }}" class="mb-3">
    <div class="d-flex">
        <select name="status" class="form-select me-2" style="width: 200px;">
            <option value="">-- Semua Status --</option>
            <option value="belum_lunas" {{ request('status') == 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
            <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
        </select>
        <button type="submit" class="btn btn-primary me-2">Filter</button>
        <a href="{{ route('admin.bagihasil.export.pdf', ['status' => request('status')]) }}" class="btn btn-danger">Export PDF</a>
    </div>
</form>

<table class="table table-bordered">
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
            <td>
                @if($bagi->status == 'lunas')
                    <span class="badge bg-success">Lunas</span>
                @else
                    <span class="badge bg-warning text-dark">Belum Lunas</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
