@extends('layouts.appadmin')

@section('content')
<section class="vh-100">
    <div class="container mt-5 pt-5" style="margin-top: 7em;">
        <h2>Tambah Order Baru</h2>
        <form method="POST" action="{{ route('admin.storeOrder') }}">
            @csrf

            <div class="form-group mb-3">
                <label for="customer_id">Pelanggan:</label>
                <select class="form-control" id="customer_id" name="customer_id" required>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="laundry_id">Laundry:</label>
                <select class="form-control" id="laundry_id" name="laundry_id" required>
                    @foreach($laundries as $laundry)
                        <option value="{{ $laundry->id }}">{{ $laundry->nama_pelanggan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="type">Jenis Layanan:</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="Cuci Kering">Cuci Kering</option>
                    <option value="Cuci Setrika">Cuci Setrika</option>
                    <option value="Setrika Saja">Setrika Saja</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="weight">Berat (Kg):</label>
                <input type="number" class="form-control" id="weight" name="weight" step="0.1" required>
            </div>

            <div class="form-group mb-3">
                <label for="total_price">Total Harga (Rp):</label>
                <input type="number" class="form-control" id="total_price" name="total_price" required>
            </div>

            <div class="form-group mb-3">
                <label for="order_date">Tanggal Order:</label>
                <input type="date" class="form-control" id="order_date" name="order_date" required>
            </div>

            <div class="form-group mb-3">
                <label for="note">Catatan:</label>
                <textarea class="form-control" id="note" name="note"></textarea>
            </div>

            <div class="form-group mb-4">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Menunggu">Menunggu</option>
                    <option value="Diproses">Diproses</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Diambil">Diambil</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Tambah Order</button>
        </form>
    </div>
</section>
@endsection
