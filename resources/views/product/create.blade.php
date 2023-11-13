@extends('layouts.master')

@section('title', 'Produk | Tambah')

@section('page-title', 'Tambah Produk Baru')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('product.index') }}">Produk</a></li>
<li class="breadcrumb-item">Tambah</li>
@endsection

@section('content')
<div class="card card-success">
    <div class="card-header">
        <div class="card-title">Tambah Produk Baru</div>
    </div>
    <form action="{{ route('product.store') }}" method="post">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="control-label required">Nama Produk</label>
                        <input type="text" placeholder="Nama Produk" class="form-control @error('name') is-invalid @enderror" autofocus
                            value="{{ old('name') }}" id="name" name="name">
                        @error('name')
                        <span class="text-danger fw-bold">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category_id" class="required">Kategori Produk</label>
                        <select name="category_id" class="select2 w-100 form-control @error('category_id') is-invalid @enderror" id="category_select">
                            <option value="" class="bg-secondary" disabled selected> Pilih Kategori Produk </option>
                            @foreach ($categoryList as $category)
                            <option {{ old('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}" >{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger fw-bold">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="stock" class="required">Harga Jual</label>
                            <input type="tel" value="{{ old('price') }}" name="price" id="price"
                                class="form-control deleteString @error('price') is-invalid @enderror" placeholder="Harga">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="stock" class="required">Stok</label>
                            <input type="tel" value="{{ old('stock') }}" name="stock" id="stock"
                                class="form-control deleteString @error('stock') is-invalid @enderror" placeholder="Stock">
                                @error('stock')
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

<script>
    $(document).ready(function () {
        $(".select2").select2({
            theme: 'bootstrap4',
        });

        $(".deleteString").keyup(function (e) { 
                    const str = $(this).val();
                    const result = str.replace(/\D/g, '');
                    $(this).val(result);
        });
    });



</script>

@endsection
