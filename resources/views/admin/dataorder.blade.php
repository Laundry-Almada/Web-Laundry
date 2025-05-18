@extends('layouts.appadmin')

@section('content')
<div class="container mt-5 pt-5">
    <h2>Data Order</h2>

    <!-- Button to Add Order -->
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
@endsection
