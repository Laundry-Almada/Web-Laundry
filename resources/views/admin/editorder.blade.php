@extends('layouts.appadmin')

@section('title', 'Edit Order')

@section('content')
<style>
    .form-label {
        font-weight: 600;
        color: #0d3b66;
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 10px 12px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0d3b66;
        box-shadow: 0 0 0 0.2rem rgba(13, 59, 102, 0.25);
    }

    .card-header-custom {
        background-color: #0d3b66;
        color: #ffffff;
        border-radius: 10px 10px 0 0;
    }

    .btn-outline-primary {
        border-color: #0d3b66;
        color: #0d3b66;
    }

    .btn-outline-primary:hover {
        background-color: #0d3b66;
        color: #ffffff;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: #ffffff;
    }

    .card {
        border-radius: 12px;
        border: none;
    }
</style>

<div class="container mt-5 pt-4">
    <div class="card shadow-sm">
        <div class="card-header card-header-custom">
            <h5 class="mb-0">Edit Order</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.updateOrder', $order->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="customer_name" class="form-label">Nama Customer</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name"
                           value="{{ $order->customer_name }}" required>
                </div>

                <div class="mb-3">
                    <label for="service_id" class="form-label">Jenis Layanan</label>
                    <select name="service_id" id="service_id" class="form-select" required>
                        <option value="">-- Pilih Jenis Layanan --</option>
                        @foreach($services as $service)
                            <option value="{{ $service['id'] }}"
                                    data-price="{{ $service['price'] }}"
                                    {{ old('service_id') == $service['id'] ? 'selected' : '' }}>
                                {{ $service['name'] }} (Rp {{ number_format($service['price'], 0, ',', '.') }}/kg)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="weight" class="form-label">Berat (Kg)</label>
                    <input type="number" class="form-control" id="weight" name="weight"
                           value="{{ $order->weight }}" step="0.1" required>
                </div>

                <div class="mb-3">
                    <label for="total_price" class="form-label">Total Harga (Rp)</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control" id="total_price" name="total_price"
                               value="{{ $order->total_price }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="order_date" class="form-label">Tanggal Order</label>
                    <input type="date" class="form-control" id="order_date" name="order_date"
                           value="{{ date('Y-m-d', strtotime($order->order_date)) }}" required>
                </div>

                <div class="mb-3">
                    <label for="note" class="form-label">Catatan</label>
                    <textarea class="form-control" id="note" name="note" rows="3" placeholder="Opsional...">{{ $order->note }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Diproses</option>
                        <option value="ready_picked" {{ old('status') == 'ready_picked' ? 'selected' : '' }}>Siap Diambil</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.orders') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-save"></i> Update Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
