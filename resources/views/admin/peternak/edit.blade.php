@extends('admin.layouts.master')
@section('title', 'Edit Peternak')

@section('content')
    <h1>Edit Data Peternak</h1>

    <form action="{{ route('admin.peternak.update', $peternak->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.peternak.form')
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
