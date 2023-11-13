@extends('layouts.master')

@section('title', 'Supplier | Tambah')

@section('page-title', 'Tambah Supplier Baru')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Supplier</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="card card-success">
    <div class="card-header">
        <div class="card-title">Edit Supplier Baru</div>
    </div>
    <form action="{{ route('supplier.update', $supplier->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name" class="form-label required">Nama Supplier</label>
                <input type="text" name="name" value="{{ old('name', $supplier->name) }}" autofocus placeholder="Nama supplier" id="name" class="w-50 form-control @error('name') is-invalid @enderror">
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
