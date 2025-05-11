<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laundry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LaundryController extends Controller
{
    public function index()
    {
        Log::info('Mengakses halaman daftar laundry');
        $laundries = Laundry::latest()->get();
        return view('admin.laundries.index', compact('laundries'));
    }

    public function create()
    {
        Log::info('Mengakses halaman tambah laundry');
        return view('admin.laundries.create');
    }

    public function store(Request $request)
    {
        Log::info('Mencoba menambah laundry baru', ['data' => $request->all()]);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        $laundry = Laundry::create($validated);
        Log::info('Berhasil menambah laundry baru', ['id' => $laundry->id]);

        return redirect()->route('admin.laundryIndex')
            ->with('success', 'Laundry berhasil ditambahkan');
    }

    public function edit(Laundry $laundry)
    {
        Log::info('Mengakses halaman edit laundry', ['id' => $laundry->id, 'status' => $laundry->status]);
        return view('admin.laundries.edit', compact('laundry'));
    }

    public function update(Request $request, Laundry $laundry)
    {
        Log::info('Mencoba update laundry', [
            'id' => $laundry->id,
            'data' => $request->all(),
            'current_status' => $laundry->status
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        Log::info('Data yang akan diupdate', ['validated_data' => $validated]);

        $laundry->update($validated);
        Log::info('Berhasil update laundry', [
            'id' => $laundry->id,
            'new_status' => $laundry->status
        ]);

        return redirect()->route('admin.laundryIndex')
            ->with('success', 'Laundry berhasil diperbarui');
    }

    public function destroy(Laundry $laundry)
    {
        Log::info('Mencoba hapus laundry', ['id' => $laundry->id]);
        $laundry->delete();
        Log::info('Berhasil hapus laundry', ['id' => $laundry->id]);

        return redirect()->route('admin.laundryIndex')
            ->with('success', 'Laundry berhasil dihapus');
    }
}
