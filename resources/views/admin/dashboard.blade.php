@extends('layouts.appadmin')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="mb-4">Dashboard</h2>
        </div>
    </div>

    <!-- Statistik Utama -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Customers</h5>
                    <h2 class="card-text">{{ $totalCustomers ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Laundries</h5>
                    <h2 class="card-text">{{ $totalLaundries ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <h2 class="card-text">{{ $totalOrders ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <h2 class="card-text">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Order Statistics</h5>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="orderStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Monthly Orders</h5>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="monthlyOrdersChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Revenue -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Monthly Revenue</h5>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="monthlyRevenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Recent Orders</h5>
                </div>
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders ?? [] as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->customer->name ?? '-' }}</td>
                                    <td>{{ $order->laundry->name ?? '-' }}</td>
                                    <td>{{ $order->order_date ? date('d/m/Y', strtotime($order->order_date)) : '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'washed' ? 'info' : ($order->status === 'dried' ? 'success' : ($order->status === 'ironed' ? 'primary' : ($order->status === 'ready_picked' ? 'secondary' : ($order->status === 'completed' ? 'success' : 'danger'))))) }}">
                                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                        </span>
                                    </td>
                                    <td>Rp {{ number_format($order->total_price ?? 0, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('admin.editOrder', $order->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.deleteOrder', $order->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
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
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data untuk grafik
    const orderStatusData = JSON.parse('{!! json_encode($orderStatusData ?? []) !!}');
    const monthlyOrdersData = JSON.parse('{!! json_encode($monthlyOrdersData ?? []) !!}');
    const monthlyRevenueData = JSON.parse('{!! json_encode($monthlyRevenueData ?? []) !!}');
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    // Grafik Status Order
    const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
    new Chart(orderStatusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Washed', 'Dried', 'Ironed', 'Ready to Pick', 'Completed', 'Cancelled'],
            datasets: [{
                data: [
                    orderStatusData.pending,
                    orderStatusData.washed,
                    orderStatusData.dried,
                    orderStatusData.ironed,
                    orderStatusData.ready_picked,
                    orderStatusData.completed,
                    orderStatusData.cancelled
                ],
                backgroundColor: [
                    '#ffc107', // warning - pending
                    '#17a2b8', // info - washed
                    '#28a745', // success - dried
                    '#007bff', // primary - ironed
                    '#6c757d', // secondary - ready_picked
                    '#20c997', // success - completed
                    '#dc3545'  // danger - cancelled
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                title: {
                    display: true,
                    text: 'Order Status Distribution'
                }
            }
        }
    });

    // Grafik Order per Bulan
    const monthlyOrdersCtx = document.getElementById('monthlyOrdersChart').getContext('2d');
    const monthLabels = Object.keys(monthlyOrdersData).map(month => months[parseInt(month) - 1]);

    new Chart(monthlyOrdersCtx, {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Orders',
                data: Object.values(monthlyOrdersData),
                borderColor: '#17a2b8',
                tension: 0.1,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                title: {
                    display: true,
                    text: 'Monthly Orders'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Grafik Pendapatan per Bulan
    const monthlyRevenueCtx = document.getElementById('monthlyRevenueChart').getContext('2d');

    new Chart(monthlyRevenueCtx, {
        type: 'bar',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Revenue',
                data: Object.values(monthlyRevenueData),
                backgroundColor: '#28a745'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                title: {
                    display: true,
                    text: 'Monthly Revenue'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush

@section('styles')
<style>
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    margin-bottom: 1rem;
}
.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid rgba(0,0,0,.125);
}
.badge {
    font-size: 0.875rem;
    padding: 0.5em 0.75em;
}
</style>
@endsection
