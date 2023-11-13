@extends('layouts.master')

@section('title', 'Kategori')

@section('page-title', 'Kategori')

@section('breadcrumb')
    <li class="breadcrumb-item">Kategori</li>
@endsection

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <div class="card-title">Kategori</div>
        </div>
        <div class="card-body">
            <a href="{{ route('category.create') }}" class="btn btn-primary w-100">Tambah Kategori Baru</a>
            <div class=" mt-3 table-responsive">
                <table class="table table-bordered" id="categoryTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tgl dibuat</th>
                            <th>Tgl diperbarui</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" data-display="static" type="button"
                                        id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Aksi
                                    </button>
    
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{ route('category.edit', $category->id) }}">Edit
                                            &nbsp; <i class="fas fa fa-edit"></i></a>
                                            <button type="button" onclick="deleteCategory('{{ route('category.destroy', $category->id) }}')" class="dropdown-item">Delete &nbsp; <i
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
                            <th>Tgl dibuat</th>
                            <th>Tgl diperbarui</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <form action="" id="deleteCategoryForm" method="post">
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
        $("#categoryTable").DataTable({
            searching: true,
            pageLength: 10,
            processing: true,
            language: {
                emptyTable: "Tidak ada data"
            }
        });

    });

    function deleteCategory(url) {
        // console.log(e);
            $("#deleteCategoryForm").attr("action", url);

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
                        'Data berhasil terhapus.',
                        'success'
                    )
                    $("#deleteCategoryForm").submit();
                }
            })
    }

</script>

@endsection