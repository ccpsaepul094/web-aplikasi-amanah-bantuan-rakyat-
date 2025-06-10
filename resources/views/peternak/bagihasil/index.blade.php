@extends('peternak.layouts.master')

@section('content')
    <h2>📑 Riwayat Bagi Hasil</h2>

@if(session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif

    <form method="GET" action="{{ route('peternak.bagihasil.index') }}" class="mb-3">
    <select name="status" onchange="this.form.submit()">
        <option value="">-- Semua Status --</option>
        <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
        <option value="belum_lunas" {{ request('status') == 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
    </select>
</form>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Tanggal</th>
                <th>ID Ternak</th>
                <th>Total</th>
                <th>Dibayar</th>
                <th>Status</th>
                <th>Bayar Cicilan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bagiHasils as $item)
                <tr>
                    <td>{{ $item->kegiatan->tgl_kegiatan }}</td>
                    <td>{{ $item->kegiatan->ternak->id }}</td>
                    <td>Rp{{ number_format($item->total_tagihan) }}</td>
                    <td>Rp{{ number_format($item->jumlah_dibayar) }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>
                        @if($item->status == 'belum_lunas')
                        <form method="POST" action="{{ route('peternak.bagihasil.bayar', $item->id) }}">
                            @csrf
                            <input type="number" name="jumlah_bayar" min="1" max="{{ $item->total_tagihan - $item->jumlah_dibayar }}" required>
                            <button type="submit">Bayar</button>
                        </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
