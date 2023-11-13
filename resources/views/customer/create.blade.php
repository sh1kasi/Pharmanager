@extends('layouts.master')

@section('title', 'Kustomer | Daftar')

@section('page-title', 'Daftar Kustomer Baru')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">Kustomer</a></li>
    <li class="breadcrumb-item">Tambah</li>
@endsection

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <div class="card-title">Daftar Kustomer Baru</div>
        </div>
        <form action="{{ route('customer.store') }}" method="post">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="control-label required">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" autofocus value="{{ old('name') }}" id="name" name="name">
                        @error('name')
                            <span class="text-danger fw-bold">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address" class="control-label required">Alamat</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" autofocus value="{{ old('address') }}" id="address" name="address">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone" class="control-label required">Nomor</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" autofocus value="{{ old('phone') }}" id="phone" name="phone">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>
@endsection