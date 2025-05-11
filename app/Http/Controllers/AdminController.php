<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminLaundryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        Log::info('AdminController instantiated.');
    }

    public function index()
    {
        Log::info('Loading all laundries for admin dashboard.');
        $laundries = Laundry::all();
        return view('adminlaundry.index', compact('laundries'));
    }

    public function create()
    {
        Log::info('Loading form to create new laundry.');
        $services = Service::all();
        return view('adminlaundry.create', compact('services'));
    }

    public function store(Request $request)
    {
        Log::info('Storing new laundry data.');

        $request->validate([
            'laundry_name' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
            'service_name' => 'required|string',
            'berat' => 'required|numeric|min:0',
            'status' => 'required|in:Menunggu,Proses,Selesai,Diambil',
        ]);

        try {
            $laundry = new Laundry();
            $laundry->laundry_name = $request->laundry_name;
            $laundry->alamat = $request->alamat;
            $laundry->nomor_telepon = $request->nomor_telepon;
            $laundry->service_name = $request->service_name;
            $laundry->berat = $request->berat;
            $laundry->status = $request->status;
            $laundry->save();

            Log::info('Berhasil menyimpan data laundry.');

            return redirect()->route('adminlaundry.index')->with('success', 'Data laundry berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan data laundry: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan data laundry: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        Log::info('Editing laundry with ID: ' . $id);

        try {
            $laundry = Laundry::findOrFail($id);
            $services = Service::all();
            return view('adminlaundry.edit', compact('laundry', 'services'));
        } catch (\Exception $e) {
            Log::error('Gagal mengambil data laundry: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengambil data laundry.');
        }
    }

    public function update(Request $request, $id)
    {
        Log::info('Updating laundry with ID: ' . $id);

        $request->validate([
            'laundry_name' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
            'service_name' => 'required|string',
            'berat' => 'required|numeric|min:0',
            'status' => 'required|in:Menunggu,Proses,Selesai,Diambil',
        ]);

        try {
            $laundry = Laundry::findOrFail($id);
            $laundry->laundry_name = $request->laundry_name;
            $laundry->alamat = $request->alamat;
            $laundry->nomor_telepon = $request->nomor_telepon;
            $laundry->service_name = $request->service_name;
            $laundry->berat = $request->berat;
            $laundry->status = $request->status;
            $laundry->save();

            Log::info('Laundry berhasil diperbarui.');

            return redirect()->route('adminlaundry.index')->with('success', 'Data laundry berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui data laundry: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui data laundry.');
        }
    }

    public function destroy($id)
    {
        Log::info('Deleting laundry with ID: ' . $id);

        try {
            $laundry = Laundry::findOrFail($id);
            $laundry->delete();

            Log::info('Data laundry berhasil dihapus.');
            return redirect()->route('adminlaundry.index')->with('success', 'Data laundry berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus data laundry: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus data laundry.');
        }
    }

    public function show($id)
    {
        Log::info('Showing details for laundry with ID: ' . $id);

        try {
            $laundry = Laundry::findOrFail($id);
            return view('adminlaundry.show', compact('laundry'));
        } catch (\Exception $e) {
            Log::error('Gagal menampilkan detail laundry: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menampilkan detail laundry.');
        }
    }
}
