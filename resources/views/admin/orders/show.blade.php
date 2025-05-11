@extends('layouts.appadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Detail Order</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">ID Order:</div>
                        <div class="col-md-8">{{ $order->id }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Customer:</div>
                        <div class="col-md-8">{{ $order->customer->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Laundry:</div>
                        <div class="col-md-8">{{ $order->laundry->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Tanggal Order:</div>
                        <div class="col-md-8">{{ date('d/m/Y', strtotime($order->order_date)) }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Status:</div>
                        <div class="col-md-8">
                            <span class="badge bg-{{ $order->status === 'Menunggu' ? 'warning' : ($order->status === 'DiProses' ? 'info' : ($order->status === 'Dapat Diambil' ? 'success' : 'secondary')) }}">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Total Harga:</div>
                        <div class="col-md-8">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Catatan:</div>
                        <div class="col-md-8">{{ $order->notes ?? '-' }}</div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.editOrder', $order) }}" class="btn btn-primary">Edit Order</a>
                        <a href="{{ route('admin.orders') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
