@extends('layouts.master')

@section('title', 'Kategori | Tambah')

@section('page-title', 'Tambah Kategori Baru')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('category.index') }}">Kategori</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="card card-success">
    <div class="card-header">
        <div class="card-title">Tambah Kategori Baru</div>
    </div>
    <form action="{{ route('category.store') }}" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name" class="form-label required">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name') }}" autofocus placeholder="Nama kategori" id="name" class="w-50 form-control @error('name') is-invalid @enderror">
                @error('name')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
