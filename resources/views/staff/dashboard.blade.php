@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard Staff</h2>
    <div class="card">
        <div class="card-header">Recent Orders</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Laundry</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer->name ?? '-' }}</td>
                            <td>{{ $order->laundry->name ?? '-' }}</td>
                            <td>{{ $order->order_date ? date('d/m/Y', strtotime($order->order_date)) : '-' }}</td>
                            <td>{{ $order->status }}</td>
                            <td>Rp {{ number_format($order->total_price ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No recent orders</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
