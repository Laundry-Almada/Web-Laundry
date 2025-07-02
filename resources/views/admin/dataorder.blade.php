@extends('layouts.appadmin')

@section('content')
<style>
    .custom-table {
        border-collapse: separate;
        border-spacing: 0 10px;
        width: 100%;
    }

    .custom-table th {
        background-color: #0d3b66;
        color: #fff;
        text-align: center;
        padding: 12px;
        border-radius: 00px 0px 0 0;
    }

    .custom-table td {
        background-color: #1d4e89;
        color: #fff;
        padding: 12px;
        vertical-align: middle;
        text-align: center;
    }

    .custom-table td:first-child {
        border-radius: 10px 0 0 10px;
    }

    .custom-table td:last-child {
        border-radius: 0 10px 10px 0;
    }

    .custom-table .text-end {
        text-align: right;
    }

    .badge {
        font-size: 0.8rem;
        padding: 0.4em 0.6em;
        border-radius: 10px;
    }

    .btn-outline-primary, .btn-outline-danger {
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 50px;
    }

    .card {
        border: none;
    }

    .card-header {
        border-radius: 10px 10px 0 0;
    }
    
    .bg-deep-blue {
        background-color: #0d3b66 !important;
    }
</style>

<div class="container mt-5 pt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-deep-blue text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Order</h5>
            <a href="{{ route('admin.tambahOrder') }}" class="btn btn-light btn-sm">+ Tambah Order</a>
        </div>
        <div class="card-body table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Laundry ID</th>
                        <th>Tanggal Order</th>
                        <th>Jenis</th>
                        <th>Berat (Kg)</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->customer->name ?? '-' }}</td>
                        <td>{{ $order->laundry_id ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</td>
                        <td>{{ $order->jenis ?? '-' }}</td>
                        <td>{{ $order->weight }}</td>
                        <td class="text-end">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $status = strtolower($order->status);
                                $badgeColor = match($status) {
                                    'pending' => 'secondary',
                                    'diproses', 'processing' => 'warning text-dark',
                                    'siap diambil', 'ready_picked' => 'info',
                                    'selesai', 'completed' => 'success',
                                    'batal', 'canceled' => 'danger',
                                    default => 'dark',
                                };
                            @endphp
                            <span class="badge bg-{{ $badgeColor }} text-capitalize">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td>{{ $order->note ?? '-' }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.editOrder', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.deleteOrder', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="background:#fff; color:#000;" class="text-center">Belum ada data order.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection



<!-- @extends('layouts.appadmin')

@section('content')
<div class="container mt-5 pt-5">
    <h2>Data Order</h2>

    <a href="{{ route('admin.tambahOrder') }}" class="btn btn-success mb-3">Tambah Order</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Laundry ID</th>
                <th>Tanggal Order</th>
                <th>Jenis</th>
                <th>Berat (Kg)</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->customer->name ?? '-' }}</td>
                <td>{{ $order->laundry_id ?? '-' }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ $order->jenis ?? '-' }}</td>
                <td>{{ $order->weight }}</td>
                <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->note ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.editOrder', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.deleteOrder', $order->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection -->
