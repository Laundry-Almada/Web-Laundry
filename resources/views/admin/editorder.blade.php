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
                <label for="service_id">Service:</label>
                <select class="form-control" id="service_id" name="service_id" required>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ $order->service_id == $service->id ? 'selected' : '' }}>
                            {{ $service->name }} ({{ $service->laundry->name }})
                        </option>
                    @endforeach
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
                <input type="datetime-local" class="form-control" id="order_date" name="order_date" value="{{ date('Y-m-d\TH:i', strtotime($order->order_date)) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="note">Catatan:</label>
                <textarea class="form-control" id="note" name="note">{{ $order->note }}</textarea>
            </div>

            <div class="form-group mb-4">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="washed" {{ $order->status == 'washed' ? 'selected' : '' }}>Dicuci</option>
                    <option value="dried" {{ $order->status == 'dried' ? 'selected' : '' }}>Dikeringkan</option>
                    <option value="ironed" {{ $order->status == 'ironed' ? 'selected' : '' }}>Disetrika</option>
                    <option value="ready_picked" {{ $order->status == 'ready_picked' ? 'selected' : '' }}>Siap Diambil</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</section>
@endsection
