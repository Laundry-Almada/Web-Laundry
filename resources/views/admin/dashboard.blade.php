@extends('layouts.appadmin')

@section('content')
<div class="container mt-5 pt-5">
    <h2>Dashboard</h2>

    <div class="row mt-4">
        <!-- Total Orders Card -->
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <h2 class="card-text">{{ $totalOrders }}</h2>
                </div>
            </div>
        </div>

        <!-- Total Laundries Card -->
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Laundries</h5>
                    <h2 class="card-text">{{ $totalLaundries }}</h2>
                </div>
            </div>
        </div>

        <!-- Total Customers Card -->
        <div class="col-md-3 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Customers</h5>
                    <h2 class="card-text">{{ $totalCustomers }}</h2>
                </div>
            </div>
        </div>

        <!-- Pending Orders Card -->
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Pending Orders</h5>
                    <h2 class="card-text">{{ $pendingOrders }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Recent Orders</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders ?? [] as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->customer->name ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'completed' ? 'success' : 'info') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.editOrder', $order->id) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <a href="{{ route('admin.viewOrder', $order->id) }}" class="btn btn-info">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                        <form action="{{ route('admin.deleteOrder', $order->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
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
