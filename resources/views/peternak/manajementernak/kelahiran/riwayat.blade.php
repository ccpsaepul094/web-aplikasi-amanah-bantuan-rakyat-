@extends('peternak.layouts.master')

@section('content')
    <h2>📜 Riwayat Kelahiran Ternak</h2>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <a href="{{ route('peternak.manajementernak.kelahiran.create') }}">➕ Tambah Data Kelahiran</a>

    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 20px;">
        <thead>
            <tr>
                <th>Tanggal Kelahiran</th>
                <th>Induk</th>
                <th>Foto</th>
                <th>Keterangan</th>
                <th>Anak Ternak</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kegiatans as $kegiatan)
                <tr>
                    <td>{{ $kegiatan->tgl_kegiatan }}</td>
                    <td>{{ $kegiatan->ternak->nama ?? '-' }} (ID: {{ $kegiatan->ternak->id }})</td>
                    <td>
                        @if($kegiatan->foto_kegiatan)
                            <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}" width="100">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $kegiatan->keterangan ?? '-' }}</td>
                    <td>
                        @if($kegiatan->ternak->anak->count())
                            <ul>
                                @foreach($kegiatan->ternak->anak as $anak)
                                    <li>
                                        Tag: {{ $anak->nama ?? '-' }},
                                        Kelamin: {{ $anak->jns_kelamin }},
                                        Lahir: {{ $anak->tgl_lahir }},
                                        Status: {{ $anak->status }}
                                        
                                        <form action="{{ route('peternak.manajementernak.kelahiran.anak.destroy', $anak->id) }}"
                                              method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus anak ini?')">🗑 Hapus</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            Tidak ada data anak.
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada riwayat kelahiran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
