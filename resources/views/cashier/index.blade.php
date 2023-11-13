@extends('layouts.master')

@section('title', 'Kasir')

@section('page-title', 'Kasir')

@section('breadcrumb')
<li class="breadcrumb-item active">Kasir</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
                <div class="card-title">Keranjang</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead class="border-bottom border-dark">
                            <tr>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tbody>
                                @foreach ($carts as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td style="min-width: 170px;">
                                        <form action="{{ route('cashier.updateCartItem', $item->rowId) }}" method="POST">
                                            @csrf
                                            <div class="input-group">
                                                @error('qty')
                                                    <span class="text-danger fw-bold">{{ $message }}</span>
                                                @enderror
                                                <input type="number" class="form-control" name="qty" required value="{{ old('qty', $item->qty) }}">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-success border-none" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sumbit"><i class="fas fa-check"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td>@currency($item->price)</td>
                                    <td>@currency($item->subtotal)</td>
                                    <td>
                                        <div class="d-flex">
                                            <form action="{{ route('cashier.removeCartItem', $item->rowId) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </tbody>
                    </table>
                </div>
                <form action="{{ route('order.store') }}" method="post" id="order_store">
                    @csrf
                    <div class="row">
                        <div class="form-group mt-3 col-md-12">
                            <label for="customer_id">Kustomer</label>
                            <select name="customer_id" id="customer_id" class="form-control select2 @error('customer_id') is-invalid @enderror">
                                <option value="" selected disabled>Pilih Kustomer</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <span class="text-danger fw-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-sm">Total Produk</label>
                            <div class="form-control form-control-solid text-danger"><strong>{{ Cart::count() }}</strong></div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-sm">Total</label>
                            <div class="form-control form-control-solid text-danger"><strong>{{ Cart::total() }}</strong></div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label class="text-sm">Nominal Pembayaran</label>
                            <input type="tel" name="nominals" class="form-control deleteString fw-bold @error('nominals') is-invalid @enderror" id="nominal" onkeyup="inputNominal(this.value)" value="{{ old('nominal') }}">
                            <input type="tel" name="nominal" hidden class="form-control deleteString fw-bold @error('nominal') is-invalid @enderror" id="nominals">
                            @error('nominals')
                            <span class="text-danger fw-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-3">
                            <label class="text-sm">Kembalian</label>
                            <div class="form-control form-control-solid text-danger"><strong id="change"></strong></div>
                            {{-- <input type="hidden" id="total_price" value="{{ Cart::total() }}"> --}}
                        </div>
                        <div class="col-md-12 mt-3 d-flex flex-wrap align-items-center justify-content-center">
                            <a href="{{ route('customer.create') }}" class="btn btn-success mx-1">Buat Kustomer baru</a>
                            <button type="submit" id="save_transaction" class="btn btn-primary">Simpan Pembayaran</button>
                        </div>
                    </div>
                </form>
                <input type="hidden" id="total_price" name="total_price" value="{{ Cart::total() }}">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
                <div class="card-title">List Produk</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead class="border-bottom border-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Stok</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>@currency($product->price)</td>
                                    <td>
                                        <div class="d-flex">
                                            <form action="{{ route('cashier.addCartItem', $product->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="name" value="{{ $product->name }}">
                                                <input type="hidden" name="price" value="{{ $product->price }}">

                                                <button type="submit" class="btn btn-outline-primary btn-sm">
                                                    <i class="fa fa-solid fa-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
    <script>
        $(document).ready(function () {
        toastr.options.positionClass = 'toast-bottom-right'

            toastr.success("{{ session('success') }}", 'Berhasil')
        });
    </script>
@elseif (session('error'))
    <script>
        $(document).ready(function () {
        toastr.options.positionClass = 'toast-bottom-right'

            toastr.error("{{ session('error') }}", 'Gagal!')
        });
    </script>
@endif



<script>
    $(document).ready(function () {
        $(".select2").select2({
            theme: 'bootstrap4',
        });

        $("#save_transaction").click(function (e) { 
            e.preventDefault();
            const setTrueNominal =  parseInt($('#nominal').val().split('.').join(''));
            const trueTotalPrice = parseInt($('#total_price').val().split('.').join(''));
            $('#nominals').val(setTrueNominal);
            console.log($('#nominals').val());
            // $('#total_price').val(trueTotalPrice);
            $('#order_store').submit();

        });

    });

    function inputNominal(nominal) {
        $(document).ready(function () {

            $(".deleteString").keyup(function (e) { 
                    const str = $(this).val();
                    const result = str.replace(/\D/g, '');
                    $(this).val(result);
            });

            $('#nominal').keyup(function (e) { 
            const angka = $(this).val();

            const hasilAngka = formatRibuan(angka);
            $(this).val(hasilAngka);

        });

            const total_price = parseInt($("#total_price").val().split('.').join(''));
            const input_nominal = parseInt(nominal.split('.').join(''));
            console.log(input_nominal > total_price);
            if (input_nominal > total_price) {
                $("#change").html((input_nominal - total_price).toLocaleString('id-ID'));
            } else {
                $('#change').html("");
            }

        });
    }
    function formatRibuan(angka){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split           = number_string.split('.'),
        sisa            = split[0].length % 3,
        angka_hasil     = split[0].substr(0, sisa),
        ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
 
 
 
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            angka_hasil += separator + ribuan.join('.');
        }
 
        angka_hasil = split[1] != undefined ? angka_hasil + '.' + split[1] : angka_hasil;
        return angka_hasil;
    }

</script>
@endsection
