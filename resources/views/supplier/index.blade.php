@extends('layouts.master')

@section('title', 'Supplier')

@section('page-title', 'Supplier')

@section('breadcrumb')
<li class="breadcrumb-item">Supplier</li>
@endsection

@section('content')
<div class="card card-success">
    <div class="card-header">
        <div class="card-title">Daftar Supplier</div>
    </div>
    <div class="card-body">
        <a href="{{ route('supplier.create') }}" class="btn btn-primary w-100">Tambahkan Supplier Baru</a>

        <div class=" mt-3 table-responsive">
            <table class="table table-bordered" id="productTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Supplier</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" data-display="static" type="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Aksi
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a href="{{ route('supplier.detail.index', $supplier->id) }}" class="dropdown-item">Detail
                                        <i class="fas fa-info"></i></a>
                                    <a class="dropdown-item" href="{{ route('supplier.edit', $supplier->id) }}">Edit
                                        &nbsp; <i class="fas fa fa-edit"></i></a>
                                    <button type="button" id="deleteSupplierButton" onclick="deleteSupplier('{{ route('supplier.destroy', $supplier->id) }}')"
                                        class="dropdown-item">Delete &nbsp; <i class="fas fa fa-trash"></i></button>
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
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<form action="" id="deleteSupplierForm" method="post">
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

    function deleteSupplier(url) {
        
        $("#deleteSupplierForm").attr('action', url);
            // console.log(supplier_id);


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
                    $("#deleteSupplierForm").submit();
                }
            })
    }

</script>

@endsection
