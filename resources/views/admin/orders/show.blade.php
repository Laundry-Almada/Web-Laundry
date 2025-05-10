@extends('layouts.appadmin')

@section('content')
<div class="container mt-5 pt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Order</h5>
            <a href="{{ route('admin.orders') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>Informasi Order</h6>
                    <table class="table">
                        <tr>
                            <th>Order ID</th>
                            <td>{{ $order->barcode }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Order</th>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'completed' ? 'success' : 'info') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td>{{ $order->note ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6>Informasi Pelanggan</h6>
                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <td>{{ $order->customer->name }}</td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td>{{ $order->customer->phone }}</td>
                        </tr>
                    </table>

                    <h6 class="mt-4">Informasi Laundry</h6>
                    <table class="table">
                        <tr>
                            <th>Nama Laundry</th>
                            <td>{{ $order->laundry->name }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $order->laundry->address }}</td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td>{{ $order->laundry->phone }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <h6>Detail Layanan</h6>
                    <table class="table">
                        <tr>
                            <th>Layanan</th>
                            <td>{{ $order->service->name }}</td>
                        </tr>
                        <tr>
                            <th>Berat</th>
                            <td>{{ $order->weight }} kg</td>
                        </tr>
                        <tr>
                            <th>Total Harga</th>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('admin.editOrder', $order->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit Order
                </a>
                <form action="{{ route('admin.deleteOrder', $order->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                        <i class="bi bi-trash"></i> Hapus Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
