@extends('layouts.master')

@section('title', 'Kustomer | Daftar')

@section('page-title', 'Daftar Kustomer Baru')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">Kustomer</a></li>
    <li class="breadcrumb-item">Edit {{ $customer->name }}</li>
@endsection

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <div class="card-title">Edit data {{ $customer->name }}</div>
        </div>
        <form action="{{ route('customer.update', $customer->id) }}" method="post" >
            @method("PATCH")
            @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="control-label required">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" autofocus value="{{ old('name', $customer->name) }}" id="name" name="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address" class="control-label required">Alamat</label>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control @error('address') is-invalid @enderror" autofocus value="{{ old('address', $customer->address) }}" id="address" name="address">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone" class="control-label required">Nomor</label>
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control @error('address') is-invalid @enderror" autofocus value="{{ old('phone', $customer->phone) }}" id="phone" name="phone">
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