@extends('layouts.appadmin')

@section('title', 'Tambah Order')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tambah Order</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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

    <form action="{{ route('admin.storeOrder') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer</label>
            <select name="customer_id" class="form-select" required>
                <option value="">-- Pilih Customer --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="laundry_id" class="form-label">Laundry</label>
            <select name="laundry_id" class="form-select" required>
                <option value="">-- Pilih Laundry --</option>
                @foreach($laundries as $laundry)
                    <option value="{{ $laundry->id }}">{{ $laundry->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="order_date" class="form-label">Tanggal Order</label>
            <input type="date" name="order_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="service_id" class="form-label">Jenis Layanan</label>
            <select name="service_id" class="form-select" required>
                <option value="">-- Pilih Jenis --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="weight" class="form-label">Berat (Kg)</label>
            <input type="number" step="0.1" name="weight" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="total_price" class="form-label">Total Harga (Rp)</label>
            <input type="number" name="total_price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="pending">Menunggu</option>
                <option value="processing">Diproses</option>
                <option value="ready_picked">Siap Diambil</option>
                <option value="completed">Selesai</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Catatan</label>
            <textarea name="note" class="form-control" rows="3" placeholder="Catatan tambahan (opsional)"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
