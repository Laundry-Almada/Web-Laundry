@extends('layouts.appadmin')

@section('content')
<section class="vh-100">
    <div class="container mt-5 pt-5" style="margin-top: 7em;">
        <h2>Edit Data Order</h2>
        <form method="POST" action="{{ route('admin.updateOrder', $order->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="customer_id">Pelanggan:</label>
                <select class="form-control" id="customer_id" name="customer_id" required>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="laundry_id">Laundry:</label>
                <select class="form-control" id="laundry_id" name="laundry_id" required>
                    @foreach($laundries as $laundry)
                        <option value="{{ $laundry->id }}" {{ $order->laundry_id == $laundry->id ? 'selected' : '' }}>
                            {{ $laundry->nama_pelanggan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="type">Jenis Layanan:</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="Cuci Kering" {{ $order->type == 'Cuci Kering' ? 'selected' : '' }}>Cuci Kering</option>
                    <option value="Cuci Setrika" {{ $order->type == 'Cuci Setrika' ? 'selected' : '' }}>Cuci Setrika</option>
                    <option value="Setrika Saja" {{ $order->type == 'Setrika Saja' ? 'selected' : '' }}>Setrika Saja</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="weight">Berat (Kg):</label>
                <input type="number" class="form-control" id="weight" name="weight" value="{{ $order->weight }}" step="0.1" required>
            </div>

            <div class="form-group mb-3">
                <label for="total_price">Total Harga (Rp):</label>
                <input type="number" class="form-control" id="total_price" name="total_price" value="{{ $order->total_price }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="order_date">Tanggal Order:</label>
                <input type="date" class="form-control" id="order_date" name="order_date" value="{{ $order->order_date }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="note">Catatan:</label>
                <textarea class="form-control" id="note" name="note">{{ $order->note }}</textarea>
            </div>

            <div class="form-group mb-4">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Menunggu" {{ $order->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Diproses" {{ $order->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Diambil" {{ $order->status == 'Diambil' ? 'selected' : '' }}>Diambil</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</section>
@endsection
