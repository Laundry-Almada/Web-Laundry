@extends('layouts.appadmin')

@section('content')
<section class="vh-100 bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow rounded">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Order</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.updateOrder', $order->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Nama Pelanggan</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $order->customer_name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">Jenis Layanan</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option disabled>Pilih Jenis Layanan</option>
                                    @php
                                        $services = [
                                            "Cuci Karpet", "Cuci Jas", "Cuci Baju Reguler", "Cuci Baju Express (1 Hari)",
                                            "Setrika Reguler", "Setrika Express (1 Hari)", "Cuci Gorden", "Natur",
                                            "Cuci Sepatu", "Cuci Boneka", "Dry Cleaning"
                                        ];
                                    @endphp
                                    @foreach ($services as $service)
                                        <option value="{{ $service }}" {{ $order->type == $service ? 'selected' : '' }}>
                                            {{ $service }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="weight" class="form-label">Berat (Kg)</label>
                                <input type="number" class="form-control" id="weight" name="weight" value="{{ $order->weight }}" step="0.1" required>
                            </div>

                            <div class="mb-3">
                                <label for="total_price" class="form-label">Total Harga (Rp)</label>
                                <input type="number" class="form-control" id="total_price" name="total_price" value="{{ $order->total_price }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="order_date" class="form-label">Tanggal Order</label>
                                <input type="date" class="form-control" id="order_date" name="order_date" value="{{ date('Y-m-d', strtotime($order->order_date)) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="note" class="form-label">Catatan</label>
                                <textarea class="form-control" id="note" name="note" rows="3" placeholder="Opsional...">{{ $order->note }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="Menunggu" {{ $order->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="Diproses" {{ $order->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="Diambil" {{ $order->status == 'Diambil' ? 'selected' : '' }}>Dapat Diambil</option>
                                </select>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Update Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
