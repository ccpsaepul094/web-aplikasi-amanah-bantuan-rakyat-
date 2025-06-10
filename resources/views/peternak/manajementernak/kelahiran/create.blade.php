@extends('peternak.layouts.master')

@section('content')
    <h2>➕ Tambah Data Kelahiran</h2>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peternak.manajementernak.kelahiran.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="id_ternak">Ternak Induk:</label>
    <select name="id_ternak" required>
        <option value="">Pilih Ternak</option>
        @foreach($ternaks as $ternak)
            <option value="{{ $ternak->id }}">{{ $ternak->nama ?? 'ID '.$ternak->id }}</option>
        @endforeach
    </select><br><br>

    <label for="tgl_kegiatan">Tanggal Kelahiran:</label>
    <input type="date" name="tgl_kegiatan" required><br><br>
    <label for="jns_kelamin">Jenis Kelamin Anak:</label>
    <select name="jns_kelamin" required>
        <option value="">Pilih</option>
        <option value="jantan">Jantan</option>
        <option value="betina">Betina</option>
    </select>
    <br>


    <label for="foto_kegiatan">Foto Kegiatan:</label>
    <input type="file" name="foto_kegiatan"><br><br>

    <label for="keterangan">Keterangan:</label><br>
    <textarea name="keterangan" rows="3"></textarea><br><br>

    <button type="submit">Simpan</button>
</form>

@endsection
