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
        border-radius: 0px;
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

    .badge {
        font-size: 0.8rem;
        padding: 0.4em 0.6em;
        border-radius: 10px;
    }

    .btn-outline-primary, .btn-outline-danger, .btn-outline-warning {
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
                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</td>
                        <td>{{ $order->jenis ?? '-' }}</td>
                        <td>{{ $order->weight }}</td>
                        <td class="text-end">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $status = strtolower($order->status);
                                $badgeColor = match($status) {
                                    'pending' => 'secondary',
                                    'washed' => 'primary',
                                    'dried' => 'info',
                                    'ironed' => 'warning text-dark',
                                    'ready_picked', 'completed' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'dark',
                                };
                                $statusIndo = match($status) {
                                    'pending' => 'Menunggu',
                                    'washed' => 'Dicuci',
                                    'dried' => 'Dikeringkan',
                                    'ironed' => 'Disetrika',
                                    'ready_picked' => 'Siap Diambil',
                                    'completed' => 'Selesai',
                                    'cancelled' => 'Dibatalkan',
                                    default => ucfirst($order->status),
                                };
                            @endphp
                            <span class="badge bg-{{ $badgeColor }} text-capitalize">{{ $statusIndo }}</span>
                        </td>
                        <td>{{ $order->note ?? '-' }}</td>
                        <td>
                            <!-- Tombol Barcode -->
                            <button type="button" class="btn btn-outline-primary btn-sm me-1" onclick="showQrBarcode('{{ $order->id }}')">
                                <i class="fas fa-barcode"></i> Barcode
                            </button>
                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.editOrder', $order->id) }}" class="btn btn-outline-warning btn-sm me-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.deleteOrder', $order->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus order ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="background:#fff; color:#000;" class="text-center">Belum ada data order.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Barcode (satu kali saja, di luar perulangan) -->
<div class="modal fade" id="barcodeModal" tabindex="-1" aria-labelledby="barcodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="barcodeModalLabel">Barcode Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="qrBarcodeImg" src="" alt="Barcode" style="height:200px; width:200px;">
                <div class="mt-2"><span id="barcodeValue"></span></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
<script>
    function showQrBarcode(orderId) {
        var img = document.getElementById('qrBarcodeImg');
        img.src = 'https://api.qrserver.com/v1/create-qr-code/?data=' + orderId + '&size=240x240';
        document.getElementById('barcodeValue').innerText = orderId;
        var modal = new bootstrap.Modal(document.getElementById('barcodeModal'));
        modal.show();
    }
</script>
@endpush
@endsection
