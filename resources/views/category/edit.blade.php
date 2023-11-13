@extends('layouts.master')

@section('title', 'Kustomer | Daftar')

@section('page-title', 'Daftar Kustomer Baru')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('category.index') }}">Kustomer</a></li>
<li class="breadcrumb-item">Edit {{ $category->name }}</li>
@endsection

@section('content')
<div class="card card-success">
    <div class="card-header">
        <div class="card-title">Edit data {{ $category->name }}</div>
    </div>
    <form action="{{ route('category.update', $category->id) }}" method="post">
        @method("PATCH")
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name" class="control-label required">Nama</label>
                <input type="text" class="w-50 form-control @error('name') is-invalid @enderror" autofocus
                    value="{{ old('name', $category->name) }}" id="name" name="name">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer bg-white">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
