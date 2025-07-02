<script>
    document.addEventListener('DOMContentLoaded', function() {
        const serviceSelect = document.getElementById('service_id');
        const weightInput = document.getElementById('weight');
        const totalPriceInput = document.getElementById('total_price');

        function calculateTotal() {
            const selected = serviceSelect.options[serviceSelect.selectedIndex];
            const price = parseFloat(selected.getAttribute('data-price')) || 0;
            const weight = parseFloat(weightInput.value) || 0;
            const total = price * weight;
            totalPriceInput.value = total > 0 ? Math.round(total) : '';
        }

        // Konversi otomatis gram ke kg
        weightInput.addEventListener('blur', function() {
            let val = parseFloat(weightInput.value);
            if (!isNaN(val) && val > 100) {
                val = val / 1000;
                weightInput.value = val.toFixed(2);
                calculateTotal();
            }
        });

        serviceSelect.addEventListener('change', calculateTotal);
        weightInput.addEventListener('input', calculateTotal);
        calculateTotal();
    });
</script>
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
                    <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name', $order->customer->name ?? $order->customer_name) }}" required>
                    <input type="hidden" name="customer_id" value="{{ old('customer_id', $order->customer_id) }}">
                </div>

                <input type="hidden" name="laundry_id" value="{{ old('laundry_id', $order->laundry_id) }}">

                <div class="mb-3">
                    <label for="service_id" class="form-label">Jenis Layanan</label>
                    <select name="service_id" id="service_id" class="form-select" required readonly disabled>
                        <option value="">-- Pilih Jenis Layanan --</option>
                        @foreach($services as $service)
                            <option value="{{ $service['id'] }}"
                                    data-price="{{ $service['price'] }}"
                                    {{ (old('service_id', $order->service_id) == $service['id']) ? 'selected' : '' }}>
                                {{ $service['name'] }} (Rp {{ number_format($service['price'], 0, ',', '.') }}/kg)
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="service_id" value="{{ old('service_id', $order->service_id) }}">
                </div>

                <div class="mb-3">
                    <label for="weight" class="form-label">Berat (Kg)
                        <span style="font-weight:normal; color:#888; font-size:90%">(Contoh: 1.5 untuk 1,5kg atau 1500 untuk 1,5kg)</span>
                    </label>
                    <input type="number" class="form-control" id="weight" name="weight" step="0.1" value="{{ old('weight', $order->weight) }}" required readonly>
                </div>

                <div class="mb-3">
                    <label for="total_price" class="form-label">Total Harga (Rp)</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control" id="total_price" name="total_price"
                               value="{{ $order->total_price }}" required readonly>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const serviceSelect = document.getElementById('service_id');
        const weightInput = document.getElementById('weight');
        const totalPriceInput = document.getElementById('total_price');

        function calculateTotal() {
            const selected = serviceSelect.options[serviceSelect.selectedIndex];
            const price = parseFloat(selected.getAttribute('data-price')) || 0;
            const weight = parseFloat(weightInput.value) || 0;
            const total = price * weight;
            totalPriceInput.value = total > 0 ? Math.round(total) : '';
        }

        serviceSelect.addEventListener('change', calculateTotal);
        weightInput.addEventListener('input', calculateTotal);

        // Hitung ulang saat halaman dimuat jika sudah ada value
        calculateTotal();
    });
</script>
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
                        <option value="washed" {{ old('status') == 'washed' ? 'selected' : '' }}>Dicuci</option>
                        <option value="dried" {{ old('status') == 'dried' ? 'selected' : '' }}>Dikeringkan</option>
                        <option value="ironed" {{ old('status') == 'ironed' ? 'selected' : '' }}>Disetrika</option>
                        <option value="ready_picked" {{ old('status') == 'ready_picked' ? 'selected' : '' }}>Siap Diambil</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.orders') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <!-- Tombol barcode dihapus dari edit order -->
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-save"></i> Update Order
                    </button>
                </div>

{{-- @include('admin.partials.barcode_modal') --}}
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
<script>
function showBarcode(barcode) {
    document.getElementById('barcodeValue').innerText = barcode;
    JsBarcode("#barcodeSvg", barcode, {
        format: "CODE128",
        width: 2,
        height: 60,
        displayValue: true
    });
    var modal = new bootstrap.Modal(document.getElementById('barcodeModal'));
    modal.show();
}
</script>
            </form>
        </div>
    </div>
</div>
@endsection
