@extends('peternak.layouts.master')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data hewan ternak</h3>
                <p class="text-subtitle text-muted">Ini halaman manajemen hewan ternak</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">manajemen ternak</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    {{-- <h2>📋 Data Kelahiran</h2> --}}

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <a href="{{ route('peternak.manajementernak.kelahiran.create') }}">➕ Tambah Data Kelahiran</a>
    <a href="{{ route('peternak.manajementernak.kelahiran.riwayat') }}">📜 Lihat Riwayat Anak Ternak</a>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Tanggal</th>
                <th>Induk</th>
                <th>Foto</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kegiatans as $kegiatan)
                <tr>
                    <td>{{ $kegiatan->tgl_kegiatan }}</td>
                    <td>{{ $kegiatan->ternak->nama ?? '-' }}</td>
                    <td>
                        @if($kegiatan->foto_kegiatan)
                            <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}" width="100">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $kegiatan->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada data kelahiran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
