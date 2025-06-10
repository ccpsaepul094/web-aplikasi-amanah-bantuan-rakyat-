@extends('admin.layouts.master')

@section('content')
    <h2>Data Akun Peternak</h2>

    @if(session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

         {{-- Form Pencarian & Filter --}}
    <form method="GET" action="#" class="mb-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-6 col-sm-12">
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau email"
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-auto col-sm-6">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
            <div class="col-md-auto col-sm-6">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>
            <div class="col-md-auto col-sm-6">
                <select name="per_page" class="form-select" onchange="this.form.submit()">
                    @foreach ([5, 10, 25, 50, 100] as $size)
                        <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                            Tampilkan {{ $size }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-auto col-sm-6">
                <a href="#" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-x-circle"></i> Reset
                </a>
            </div>
        </div>
    </form>
    
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peternaks as $peternak)
                <tr>
                    <td>{{ $peternak->name }}</td>
                    <td>{{ $peternak->email }}</td>
                    <td>
                        @if($peternak->is_approved)
                            ✅ Disetujui
                        @else
                            ❌ Belum disetujui
                        @endif
                    </td>
                    <td>
                        @if(!$peternak->is_approved)
                            <form method="POST" action="{{ route('admin.peternak.approve', $peternak->id) }}">
                                @csrf
                                <button type="submit">Setujui</button>
                            </form>
                        @else
                            <em>Sudah aktif</em>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">Tidak ada data peternak</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
