@extends('layouts.master')

@section('title', 'Home')

@section('page-title', 'Dashboard')

@section('breadcrumb')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="card card-success">
    <div class="card-header">
        <div class="card-title"></div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $total_product }}</h3>
                        <p>Total Produk</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="{{ route('product.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $total_supplier }}<sup style="font-size: 20px"></sup></h3>

                        <p>Supplier Terdaftar</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <a href="{{ route('supplier.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $total_customer }}</h3>

                        <p>Kustomer Terdaftar</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="{{ route('customer.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>


        </div>
    </div>
</div>

@if (count($products) != 0)

<div class="card card-danger">
    <div class="card-header">
        <div class="card-title">Obat Perlu di Restock</div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="">
                    <tr>
                        <th>#</th>
                        <th>Obat</th>
                        <th>Stock</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="{{ route('product.index') }}" class="btn btn-primary">Lihat</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada obat yang perlu di stock</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

@endsection
