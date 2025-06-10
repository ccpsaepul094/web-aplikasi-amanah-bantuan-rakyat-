@extends('peternak.layouts.master')

@section('content')
    <h2>Tambah Data Ternak</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peternak.manajementernak.ternak.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Foto Ternak (opsional):</label><br>
        <input type="file" name="foto_ternak"><br><br>

        <label>Jenis Ternak:</label><br>
        <input type="text" name="jns_ternak" value="{{ old('jns_ternak') }}" required><br><br>

        <label>Umur Ternak:</label><br>
        <input type="text" name="umur_ternak" value="{{ old('umur_ternak') }}" required><br><br>

        <label>Kesehatan:</label><br>
        <select name="kesehatan" required>
            <option value="">-- Pilih --</option>
            <option value="sehat" {{ old('kesehatan') == 'sehat' ? 'selected' : '' }}>Sehat</option>
            <option value="sakit" {{ old('kesehatan') == 'sakit' ? 'selected' : '' }}>Sakit</option>
        </select><br><br>

        <label>Status:</label><br>
        <select name="status" required>
            <option value="">-- Pilih --</option>
            <option value="hidup" {{ old('status') == 'hidup' ? 'selected' : '' }}>Hidup</option>
            <option value="mati" {{ old('status') == 'mati' ? 'selected' : '' }}>Mati</option>
        </select><br><br>

        <button type="submit">Simpan</button>
    </form>
@endsection
