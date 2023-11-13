@extends('layouts.master')

@section('title')
    Supplier | {{ $supplier->name }}
@endsection

@section('page-title')
    Detail {{ $supplier->name }}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Supplier</a></li>
<li class="breadcrumb-item active">{{ $supplier->name }}</li>
@endsection

@section('content')
<div class="card card-success">
    <div class="card-header">
        <div class="card-title">Detail Produk {{ $supplier->name }}</div>
    </div>
    <div class="card-body">
        <a href="{{ route('supplier.detail.create', $supplier->id) }}" class="btn btn-primary w-100">Tambahkan Produk Baru {{ $supplier->name }}</a>

        <div class=" mt-3 table-responsive">
            <table class="table table-bordered" id="productTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Qty(Dus)</th>
                        <th>Harga/Dus</th>
                        <th>Tanggal Dibuat</th>
                        <th>Tanggal Diperbarui</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listSupDetail as $supplier_detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $supplier_detail->product->name }}</td>
                        <td>{{ $supplier_detail->quantity }}</td>
                        <td>@currency($supplier_detail->price_unit)</td>
                        <td>{{ $supplier_detail->created_at }}</td>
                        <td>{{ $supplier_detail->updated_at }}</td>
                        {{-- <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" data-display="static" type="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Aksi
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('supplier.detail.edit', ['supplier_id' => $supplier->id, 'id' => $supplier_detail->id]) }}">Edit
                                        &nbsp; <i class="fas fa fa-edit"></i></a>
                                    <button type="button" id="deleteSupplierButton" onclick="deleteSupplierDetail('{{ route('supplier.detail.destroy', $supplier_detail->id) }}')"
                                        class="dropdown-item">Delete &nbsp; <i class="fas fa fa-trash"></i></button>
                                </div>
                            </div>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Qty(Dus)</th>
                        <th>Harga/Dus</th>
                        <th>Tanggal Dibuat</th>
                        <th>Tanggal Diperbarui</th>
                        {{-- <th>AKsi</th> --}}
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<form action="" id="deleteSupplierDetailForm" method="post">
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

    function deleteSupplierDetail(url) {
        
        $("#deleteSupplierDetailForm").attr('action', url);
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
                    $("#deleteSupplierDetailForm").submit();
                }
            })
    }

</script>

@endsection
