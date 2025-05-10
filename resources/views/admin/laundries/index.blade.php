@extends('layouts.appadmin')

@section('content')
<div class="container mt-5 pt-5">
    <h2>Data Laundry</h2>

    <!-- Button to Add Laundry -->
    <a href="{{ route('admin.laundryCreate') }}" class="btn btn-success mb-3">Tambah Laundry</a>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laundries as $laundry)
                        <tr>
                            <td>{{ $laundry->name }}</td>
                            <td>{{ $laundry->address }}</td>
                            <td>{{ $laundry->phone }}</td>
                            <td>{{ $laundry->email }}</td>
                            <td>
                                <span class="badge bg-{{ $laundry->status === 'active' ? 'success' : 'danger' }}">
                                    {{ ucfirst($laundry->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.laundryEdit', $laundry->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.laundryDelete', $laundry->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data laundry</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
