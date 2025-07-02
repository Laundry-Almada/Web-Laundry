@extends('layouts.appadmin')

@section('title', 'Tambah Order')

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
            <h5 class="mb-0">Tambah Order</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.storeOrder') }}" method="POST" id="orderForm">
                @csrf

                <div class="mb-3">
                    <label for="customer_name" class="form-label">Nama Customer</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control"
                           value="{{ old('customer_name') }}" required
                           placeholder="Masukkan nama customer">
                </div>

                <div class="mb-3">
                    <label for="order_date" class="form-label">Tanggal Order</label>
                    <input type="date" name="order_date" class="form-control"
                           value="{{ old('order_date', date('Y-m-d')) }}" required>
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
                    <input type="number" step="0.1" min="0.1" name="weight" id="weight" class="form-control"
                           value="{{ old('weight') }}" required>
                </div>

                <div class="mb-3">
                    <label for="total_price" class="form-label">Total Harga (Rp)</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="total_price" id="total_price" class="form-control"
                               value="{{ old('total_price') }}" required>
                    </div>
                    <small class="text-muted">Total harga akan otomatis terhitung, tapi bisa diubah manual</small>
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

                <div class="mb-3">
                    <label for="note" class="form-label">Catatan</label>
                    <textarea name="note" class="form-control" rows="3"
                              placeholder="Catatan tambahan (opsional)">{{ old('note') }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.orders') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const serviceSelect = document.getElementById('service_id');
    const weightInput = document.getElementById('weight');
    const totalPriceInput = document.getElementById('total_price');

    function calculateTotalPrice() {
        const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
        const price = selectedOption.dataset.price || 0;
        const weight = weightInput.value || 0;
        const total = price * weight;

        if (totalPriceInput.value === '' || totalPriceInput.value == (price * (weightInput.dataset.lastWeight || 0)).toString()) {
            totalPriceInput.value = total;
        }

        weightInput.dataset.lastWeight = weight;
    }

    serviceSelect.addEventListener('change', calculateTotalPrice);
    weightInput.addEventListener('input', calculateTotalPrice);

    if (serviceSelect.value && weightInput.value) {
        calculateTotalPrice();
    }
});
</script>
@endpush
@endsection
