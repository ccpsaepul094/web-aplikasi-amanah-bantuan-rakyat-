@extends('superadmin.layouts.master')

@section('content')
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, {{ Auth::user()->name }}</p>
@endsection
