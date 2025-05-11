@extends('layouts.appadmin')

@section('content')
<section class="vh-100 bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow rounded">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Tambah Order Baru</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.storeOrder') }}">
                            @csrf

                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                    </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">Jenis Layanan</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option disabled selected>Pilih Jenis Layanan</option>
                                    <option value="Cuci Karpet">Cuci Karpet</option>
                                    <option value="Cuci Jas">Cuci Jas</option>
                                    <option value="Cuci Baju Reguler">Cuci Baju Reguler</option>
                                    <option value="Cuci Baju Express (1 Hari)">Cuci Baju Express (1 Hari)</option>
                                    <option value="Setrika Reguler">Setrika Reguler</option>
                                    <option value="Setrika Express (1 Hari)">Setrika Express (1 Hari)</option>
                                    <option value="Cuci Gorden">Cuci Gorden</option>
                                    <option value="Natur">Natur</option>
                                    <option value="Cuci Sepatu">Cuci Sepatu</option>
                                    <option value="Cuci Boneka">Cuci Boneka</option>
                                    <option value="Dry Cleaning">Dry Cleaning</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="weight" class="form-label">Berat (Kg)</label>
                                <input type="number" class="form-control" id="weight" name="weight" step="0.1" required>
                            </div>

                            <div class="mb-3">
                                <label for="total_price" class="form-label">Total Harga (Rp)</label>
                                <input type="number" class="form-control" id="total_price" name="total_price" required>
                            </div>

                            <div class="mb-3">
                                <label for="order_date" class="form-label">Tanggal Order</label>
                                <input type="date" class="form-control" id="order_date" name="order_date" required>
                            </div>

                            <div class="mb-3">
                                <label for="note" class="form-label">Catatan</label>
                                <textarea class="form-control" id="note" name="note" rows="3" placeholder="Opsional..."></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="Menunggu">Menunggu</option>
                                    <option value="Diproses">Diproses</option>
                                    <option value="Diambil">Dapat Diambil</option>
                                </select>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Tambah Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
