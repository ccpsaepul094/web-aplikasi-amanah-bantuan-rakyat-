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

    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif
    
    {{-- Tombol Tambah --}}

    <a href="{{ route('peternak.manajementernak.kelahiran.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i> Tambah data kelahiran</a>

    <a href="{{ route('peternak.manajementernak.kematian.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i> Tambah data kematian</a>


    <a href="{{ route('peternak.manajementernak.ternak.create') }}"  class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i> Tambah data ternak</a>
     {{-- Form Pencarian & Filter --}}
<form method="GET" action="{{ route('peternak.manajementernak.ternak.index') }}" class="mb-3">
    <div class="row g-2 align-items-center">
        {{-- Pencarian Umum --}}
        <div class="col-md-4 col-sm-12">
            <input type="text" name="search" class="form-control" placeholder="Cari nama, jenis kelamin, ras"
                value="{{ request('search') }}">
        </div>

        {{-- Filter Status Ternak --}}
        <div class="col-md-2 col-sm-6">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="hidup" {{ request('status') == 'hidup' ? 'selected' : '' }}>Hidup</option>
                <option value="mati" {{ request('status') == 'mati' ? 'selected' : '' }}>Mati</option>
            </select>
        </div>

        {{-- Pagination --}}
        <div class="col-md-2 col-sm-6">
            <select name="per_page" class="form-select" onchange="this.form.submit()">
                @foreach ([5, 10, 25, 50, 100] as $size)
                    <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                        Tampilkan {{ $size }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tombol Aksi --}}
        <div class="col-md-auto col-sm-6">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-search"></i> Cari
            </button>
        </div>

        <div class="col-md-auto col-sm-6">
            <a href="{{ route('peternak.manajementernak.ternak.index') }}" class="btn btn-outline-secondary w-100">
                <i class="bi bi-x-circle"></i> Reset
            </a>
        </div>
    </div>
</form>


    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Foto</th>
                <th>Jenis</th>
                <th>Umur</th>
                <th>Kesehatan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ternaks as $ternak)
                <tr>
                    <td>
                        @if ($ternak->foto_ternak)
                            <img src="{{ asset('storage/' . $ternak->foto_ternak) }}" alt="Foto Ternak" width="80">
                        @else
                            <em>Tidak ada foto</em>
                        @endif
                    </td>
                    <td>{{ $ternak->jns_ternak }}</td>
                    <td>{{ $ternak->umur_ternak }}</td>
                    <td>{{ ucfirst($ternak->kesehatan) }}</td>
                    <td>{{ ucfirst($ternak->status) }}</td>
                    <td>
                        <a href="{{ route('peternak.manajementernak.ternak.edit', $ternak->id) }}"  class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil-square"></i> Edit</a> |
                        <form action="{{ route('peternak.manajementernak.ternak.destroy', $ternak->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data ternak.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
