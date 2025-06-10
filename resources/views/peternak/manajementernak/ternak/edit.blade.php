@extends('peternak.layouts.master')

@section('content')
    <h2>Edit Data Ternak</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peternak.manajementernak.ternak.update', $ternak->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Foto Ternak (jika ingin diganti):</label><br>
        @if ($ternak->foto_ternak)
            <img src="{{ asset('storage/' . $ternak->foto_ternak) }}" width="100"><br>
        @endif
        <input type="file" name="foto_ternak"><br><br>

        <label>Jenis Ternak:</label><br>
        <input type="text" name="jns_ternak" value="{{ old('jns_ternak', $ternak->jns_ternak) }}" required><br><br>

        <label>Umur Ternak:</label><br>
        <input type="text" name="umur_ternak" value="{{ old('umur_ternak', $ternak->umur_ternak) }}" required><br><br>

        <label>Kesehatan:</label><br>
        <select name="kesehatan" required>
            <option value="">-- Pilih --</option>
            <option value="sehat" {{ $ternak->kesehatan == 'sehat' ? 'selected' : '' }}>Sehat</option>
            <option value="sakit" {{ $ternak->kesehatan == 'sakit' ? 'selected' : '' }}>Sakit</option>
        </select><br><br>

        <label>Status:</label><br>
        <select name="status" required>
            <option value="">-- Pilih --</option>
            <option value="hidup" {{ $ternak->status == 'hidup' ? 'selected' : '' }}>Hidup</option>
            <option value="mati" {{ $ternak->status == 'mati' ? 'selected' : '' }}>Mati</option>
        </select><br><br>

        <button type="submit">Update</button>
    </form>
@endsection
