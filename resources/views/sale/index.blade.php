@extends('layouts.master')

@section('title', 'Rekap Penjualan')

@section('page-title', 'Rekap Penjualan')

@section('breadcrumb')
<li class="breadcrumb-item active">Rekap Penjualan</li>
@endsection

@section('content')
<div class="card card-success">
    <div class="card-header">
        <div class="card-title">Grafik</div>
    </div>
    <div class="card-body">
        <div class="row">

            <div class="col-lg-4">
                <!-- small card -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h4>@currency($total_expenses)</h4>

                        <p>Total pengeluaran</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-chart-bar"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h4>@currency($order->sum('total'))</h4>

                        <p>Total Pendapatan</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-chart-bar"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h4>@currency($order->sum('total') - $total_expenses)</h4>

                        <p>Total Keuntungan</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-chart-bar"></i>
                    </div>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="form-group w-100">
                    <label for="from" class="form-label">{{ __('Dari tanggal') }}</label>
                    <input type="date" class="form-control" name="from" id="from">
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="form-group w-100">
                    <label for="to" class="form-label">{{ __('Sampai tanggal') }}</label>
                    <input type="date" class="form-control" name="to" id="to">
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6 d-flex justify-content-end">
                <button class="btn btn-primary w-50" id="filter">Cari</button>
            </div>
            <div class="col-md-6 d-flex justify-content-start">
                <button class="btn btn-danger w-50" id="deleteFilter">Hapus</button>
            </div>
        </div>
        <div class="chart">
            <canvas height="100" id="productChart"></canvas>
        </div>
    </div>
</div>



{{-- <script src="{{ asset('assets') }}/plugins/Chart.js/dist/Chart.min.js"></script> --}}
<script>
    const ctx = document.getElementById('productChart');
    let chartLines;
    chartLines =
        new Chart(ctx, {
            type: 'line',
            data: {
    
                labels: [
                    @foreach($chartItems as $key => $value)
                    "{{ $value['date'] }}",
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($chartItems as $key => $value) 
                            {{ $value['total'] }},
                        @endforeach
                    ],
                    label: 'Total Pendapatan',
                    fill: false,
                }]
            },
            options: {
                responsive: true,
            }
        });

    $(document).ready(function () {
        $("#filter").click(function (e) {
            e.preventDefault();

            
            const from = $('#from').val();
            const to = $('#to').val();
            const dateArray = [];
            const totalArray = [];


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('sale.findDateRange') }}",
                data: {
                    from: from,
                    to: to
                },
                dataType: "JSON",
                success: function (response) {
                    
                    response.chartItems.forEach(element => {
                                    dateArray.push(element.date)
                    })

                    response.chartItems.forEach(element => {
                                    totalArray.push(element.total)
                    })

                    console.log(dateArray);
                    console.log(totalArray);

                    $("#productChart").html("");
                    chartLines.destroy()
                    chartLines = new Chart(ctx, {
                        type: 'line',
                        data: {
                        
                            labels: dateArray,
                            datasets: [{
                                data: totalArray,
                                label: 'Total Pendapatan',
                                fill: false,
                            }]
                        },
                        options: {
                            responsive: true,
                        }
                    });
                }
            });
        });

        $("#deleteFilter").click(function (e) { 
            e.preventDefault();

            chartLines.destroy();
            $('#from').val("");
            $('#to').val("");

            chartLines = new Chart(ctx, {
            type: 'line',
            data: {
    
                labels: [
                    @foreach($chartItems as $key => $value)
                    "{{ $value['date'] }}",
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($chartItems as $key => $value) 
                            {{ $value['total'] }},
                        @endforeach
                    ],
                    label: 'Total Pendapatan',
                    fill: false,
                }]
            },
            options: {
                responsive: true,
            }
        });
        });
    });

</script>

@endsection
