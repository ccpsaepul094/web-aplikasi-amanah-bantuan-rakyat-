@extends('admin.layouts.master')
@section('title', 'Tambah Peternak')

@section('content')
    <h1>Tambah Data Peternak</h1>

    <form action="{{ route('admin.peternak.store') }}" method="POST">
        @csrf
        @include('admin.peternak.form')
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
