@extends('layouts.master')

@section('title')
    {{ $supplier->name }} | Edit
@endsection

@section('page-title')
    Detail {{ $supplier->name }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Supplier</a></li>
    <li class="breadcrumb-item"><a href="{{ route('supplier.detail.index', $supplier->id) }}">{{ $supplier->name }}</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="card-success">
        <div class="card-header">
            <div class="card-title">Edit Produk {{ $supplier->name }}</div>
        </div>
        <form action="{{ route('supplier.detail.update', ['supplier_id' => $supplier_id, 'id' => $supplier_detail->id]) }}" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="product_id">Produk</label>
                        <select name="product_id" class="form-control select2" id="product_id">
                            <option value="" selected>Pilih Produk Untuk di Restock</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ $product->id == old('product_id', $supplier_detail->product_id) ? 'selected' : '' }}>{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="qty">Qty(Dus)</label>
                        <input type="tel" name="quantity" value="{{ old('quantity', $supplier_detail->quantity) }}" class="form-control deleteString" id="qty">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="price">Harga/Dus</label>
                        <input type="tel" name="price_unit" value="{{ old('price_unit', $supplier_detail->price_unit) }}" class="form-control rupiah" id="price">
                    </div>
                </div>
            </div>
            <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Simpan</button>
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

        $('#price').keyup(function (e) { 
            const angka = $(this).val();

            const hasilAngka = formatRibuan(angka);
            $(this).val(hasilAngka);

        });

    });

    function formatRibuan(angka){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split           = number_string.split(','),
        sisa            = split[0].length % 3,
        angka_hasil     = split[0].substr(0, sisa),
        ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
 
 
 
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            angka_hasil += separator + ribuan.join('.');
        }
 
        angka_hasil = split[1] != undefined ? angka_hasil + ',' + split[1] : angka_hasil;
        return angka_hasil;
    }

</script>  
@endsection