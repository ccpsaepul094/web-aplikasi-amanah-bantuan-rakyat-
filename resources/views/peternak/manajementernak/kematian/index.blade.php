
@extends('peternak.layouts.master')

@section('content')
    <h2>📋 Riwayat Kematian Ternak</h2>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <a href="{{ route('peternak.manajementernak.kematian.create') }}">➕ Tambah Data Kematian</a>

    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 20px;">
        <thead>
            <tr>
                <th>Tanggal Kematian</th>
                <th>Nama Ternak</th>
                <th>Jenis Ternak</th>
                <th>Tanggal Lahir</th>
                <th>Foto</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kematians as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->tgl_kematian)->format('d-m-Y') }}</td>
                    <td>{{ $item->nama_ternak }}</td>
                    <td>{{ $item->jns_ternak }}</td>
                    <td>{{ $item->tgl_lahir ? \Carbon\Carbon::parse($item->tgl_lahir)->format('d-m-Y') : '-' }}</td>
                    <td>
                        @if($item->foto_kegiatan)
                            <img src="{{ asset('storage/' . $item->foto_kegiatan) }}" width="100">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data kematian ternak.</td>
                </tr>
            @endforelse
            
        </tbody>
       <form method="GET">
    <select name="tahun" onchange="this.form.submit()">
        <option value="">Semua Tahun</option>
        @for ($year = date('Y'); $year >= 2019; $year--)
            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
        @endfor
    </select>
</form>

    </table>
    {{-- <table> --}}
        
    {{-- <thead>
        <tr>
            <th>ID Ternak</th>
            <th>Jenis</th>
            <th>Umur Saat Mati</th>
            <th>Tanggal Kematian</th>
            <th>Foto</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @forelse($kematians as $data)
            <tr>
                <td>{{ $data->ternak_id }}</td>
                <td>{{ $data->jns_ternak }}</td>
                <td>{{ $data->umur_ternak }}</td>
                <td>{{ $data->tgl_kematian }}</td>
                <td>
                    @if ($data->foto_kegiatan)
                        <img src="{{ asset('storage/' . $data->foto_kegiatan) }}" width="100">
                    @else
                        -
                    @endif
                </td>
                <td>{{ $data->keterangan ?? '-' }}</td>
            </tr>
        @empty
            <tr><td colspan="6">Belum ada data kematian.</td></tr>
        @endforelse
    </tbody> --}}
</table>

@endsection

