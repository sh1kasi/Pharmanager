@extends('layouts.master') 

@section('title', 'Log Transaksi')

@section('page-title', 'Log Transaksi')

@section('breadcrumb')
    <li class="breadcrumb-item active">Log Transaksi</li>
@endsection

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <div class="card-title">Log Transaksi</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="logTransactionTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order_id</th>
                            <th>Customer</th>
                            <th>Jumlah Barang</th>
                            <th>Total Harga</th>
                            <th>Tgl Order</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->total_products }}</td>
                            <td>@currency($order->total)</td>
                            <td>{{ $order->order_date }}</td>
                            <td class="text-center">
                                <a href="{{ route('order.invoice.index', $order->id) }}"><i class="fas fa-eye text-primary"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Order_id</th>
                            <th>Customer</th>
                            <th>Jumlah Barang</th>
                            <th>Total Harga</th>
                            <th>Tgl Order</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#logTransactionTable").dataTable({
                searching: true,
                pageLength: 10,
                processing: true,
                language: {
                    emptyTable: 'Tidak ada data!',
                }
            });
        });
    </script>
@endsection