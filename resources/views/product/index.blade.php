@extends('layouts.master')

@section('title', 'Produk')

@section('page-title', 'Produk')

@section('breadcrumb')
<li class="breadcrumb-item">Produk</li>
@endsection

@section('content')
<div class="card card-success">
    <div class="card-header">
        <div class="card-title">Daftar Produk</div>
    </div>
    <div class="card-body">
        <a href="{{ route('product.create') }}" class="btn btn-primary w-100">Tambahkan Produk Baru</a>

        <div class=" mt-3 table-responsive">
            <table class="table table-bordered" id="productTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Tgl ditambahkan</th>
                        <th>Tgl diperbarui</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td class="{{ $product->stock == 0 ? 'bg-danger' : '' }}">{{ $product->stock }}</td>
                        <td>@currency($product->price)</td>
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product->updated_at }}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" data-display="static" type="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Aksi
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('product.edit', $product->id) }}">Edit
                                        &nbsp; <i class="fas fa fa-edit"></i></a>
                                        <button type="button" id="deleteProductButton" onclick="deleteProduct('{{ route('product.destroy', $product->id) }}')" class="dropdown-item">Delete &nbsp; <i
                                                class="fas fa fa-trash"></i></button>
                                            </div>
                                        </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Tgl ditambahkan</th>
                        <th>Tgl diperbarui</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<form action="" id="deleteProductForm" method="post">
    @csrf
    @method("DELETE")
</form>

@if (session('success'))
<script>
    $(document).ready(function () {
        toastr.options.positionClass = 'toast-bottom-right'
        toastr.success("{{ session('success') }}", 'Berhasil')
    });

</script>
@endif

<script>
    $(document).ready(function () {
        $("#productTable").DataTable({
            searching: true,
            pageLength: 10,
            processing: true,
            language: {
                emptyTable: "Tidak ada data"
            }
        });

    });

    function deleteProduct(url) {
            $("#deleteProductForm").attr('action', url);

            Swal.fire({
                title: 'Anda yakin?',
                text: "Data yang terhapus tidak bisa di kembalikan lagi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Terhapus!',
                        'Berhasil menghapus data',
                        'success'
                    )
                    $("#deleteProductForm").submit();
                }
            })
    }

</script>

@endsection
