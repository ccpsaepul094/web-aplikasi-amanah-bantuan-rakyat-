@extends('admin.layouts.master')

@section('content')
    <h1>Selamat Datang di Dashboard Admin</h1>

    <p>Kelola akun peternak:</p>

    <a href="{{ route('admin.peternak.index') }}">
        <button>Lihat Data Peternak</button>
    </a>
@endsection
