@extends('layouts.master')

@section('title', 'Kustomer')

@section('page-title', 'Kustomer')

@section('breadcrumb')
<li class="breadcrumb-item">Kustomer</li>
@endsection

@section('content')
<div class="card card-success">
    <div class="card-header">
        <div class="card-title">Daftar Kustomer</div>
    </div>
    <div class="card-body">
        <a href="{{ route('customer.create') }}" class="btn btn-primary w-100">Daftar Kustomer Baru</a>

        <div class=" mt-3 table-responsive">
            <table class="table table-bordered" id="customerTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. Telp</th>
                        <th>Tgl dibuat</th>
                        <th>Tgl diperbarui</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->created_at }}</td>
                        <td>{{ $customer->updated_at }}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" data-display="static" type="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Aksi
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('customer.edit', $customer->id) }}">Edit
                                        &nbsp; <i class="fas fa fa-edit"></i></a>
                                        <button type="button" id="deleteCustomerButton" onclick="customerDelete('{{ route('customer.destroy', $customer->id) }}')" class="dropdown-item">Delete &nbsp; <i
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
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. Telp</th>
                        <th>Tgl dibuat</th>
                        <th>Tgl diperbarui</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<form action=""id="deleteCustomerForm" method="post">
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
        $("#customerTable").DataTable({
            searching: true,
            pageLength: 10,
            processing: true,
            language: {
                emptyTable: "Tidak ada data"
            }
        });

    });

    function customerDelete(url) {
        $("#deleteCustomerButton").click(function (e) { 
            e.preventDefault();

            $("#deleteCustomerForm").attr('action', url);

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
                        'Berhasil menghapus data.',
                        'success'
                    )
                    $("#deleteCustomerForm").submit();
                }
            })
        });
    }

</script>

@endsection
