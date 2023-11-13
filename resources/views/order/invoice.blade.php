@extends('layouts.master')

@section('title', 'Invoice')

@section('page-title')
Invoice - {{ $order->customer->name }} &nbsp; {{ \Carbon\Carbon::parse($order->order_date)->format('Y/m/d') }}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Log Transaksi</a></li>
<li class="breadcrumb-item active">Invoice - {{ $order->customer->name }} &nbsp;
    {{ \Carbon\Carbon::parse($order->order_date)->format('Y/m/d') }}</li>
@endsection

@section('content')

<style>
    .top_rw {
        background-color: #f4f4f4;
    }

    .td_w {}

    button {
        padding: 5px 10px;
        font-size: 14px;
    }

    .invoice-box {
        max-width: 890px;
        margin: auto;
        padding: 10px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 14px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
        border-bottom: solid 1px #ccc;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: middle;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
        font-size: 12px;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }

</style>

<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top_rw">
            <td colspan="2">
                <h2 style="margin-bottom: 0px;">Invoice {{ $order->customer->name }}</h2>
                <span style=""> Nomor: #{{ $order->id }} Tanggal: {{ $order->order_date }} </span>
            </td>
        </tr>
        <tr class="top">
            <td colspan="3">
                <table>
                    <tr>
                        <td>
                            <b> To: {{ $order->customer->name }} </b> <br>

                            {{ $order->customer->address }} <br>
                            Phone: {{ $order->customer->phone }}<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <td colspan="3">
            <table cellspacing="0px" cellpadding="2px">
                <tr class="heading">
                    <td style="width:25%;">
                        PRODUCT
                    </td>
                    <td style="width:10%; text-align:center;">
                        QTY.
                    </td>
                    <td style="width:10%; text-align:right;">
                        PRICE/UNIT
                    </td>
                    <td style="width:15%; text-align:right;">
                        SUBTOTAL (IDR)
                    </td>
                </tr>
                @foreach ($oDetail as $item)    
                <tr class="item">
                    <td style="width:25%;">
                        {{ $item->product->name }}
                    </td>
                    <td style="width:10%; text-align:center;">
                        {{ $item->quantity }}
                    </td>
                    <td style="width:10%; text-align:right;">
                        @currency($item->unit_price)
                    </td>
                    <td style="width:15%; text-align:right;">
                        @currency($item->unit_price * $item->quantity)
                    </td>
                </tr>
                @endforeach
                <tr class="item" style="    background: #eee;
                border-bottom: 1px solid #ddd;">
                    <td style="width:25%;"> <b> Grand Total </b> </td>
                    <td style="width:10%; text-align:center;">
                        {{ $order->total_products }}
                    </td>
                    <td style="width:10%; text-align:right;">
                        
                    </td>
                    <td style="width:15%; text-align:right;">
                        @currency($order->total)
                    </td>
                </tr>
        </td>
    </table>
    <tr>
        <td colspan="3">
            <table cellspacing="0px" cellpadding="2px">
                <tr>
                    <td width="50%">
                        <b></b> <br>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td width="50%">
                    </td>
                    <td>
                        <b>  </b>
                        <br>
                        <br>
                        <br>
                        <br>
                        <a href="{{ route('order.invoice.print', $order->id) }}" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                        <a href="{{ route('order.invoice.pdf', $order->id) }}" target="_blank" rel="noopener noreferrer" type="button" class="btn btn-primary float-right" style="margin-left: 5px;">
                          <i class="fas fa-download"></i> Cetak PDF
                        </a><br>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </table>
</div>

@endsection