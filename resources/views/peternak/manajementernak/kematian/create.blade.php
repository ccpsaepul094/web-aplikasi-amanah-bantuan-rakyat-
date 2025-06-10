@extends('peternak.layouts.master')

@section('content')
    <h2>➕ Tambah Data Kematian Ternak</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peternak.manajementernak.kematian.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="id_ternak">Pilih Ternak:</label>
            <select name="id_ternak" required>
                <option value="">-- Pilih --</option>
                @foreach($ternaks as $ternak)
                    <option value="{{ $ternak->id }}">{{ $ternak->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="tgl_kegiatan">Tanggal Kematian:</label>
            <input type="date" name="tgl_kegiatan" required>
        </div>

        <div>
            <label for="foto_kegiatan">Foto (opsional):</label>
            <input type="file" name="foto_kegiatan" accept="image/*">
        </div>

        <div>
            <label for="keterangan">Keterangan:</label>
            <textarea name="keterangan" rows="3"></textarea>
        </div>

        <button type="submit">Simpan</button>
    </form>
@endsection
