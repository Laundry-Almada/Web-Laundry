<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Laundry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function __construct()
    {
        // Middleware auth dihapus untuk testing
    }

    public function index()
    {
        Log::info('Mengakses halaman daftar order');
        $orders = Order::with(['customer', 'laundry'])->latest()->get();
        return view('admin.dataorder', compact('orders'));
    }

    public function create()
    {
        Log::info('Mengakses halaman tambah order');
        $customers = Customer::all();
        $laundries = Laundry::all();
        return view('admin.tambahorder', compact('customers', 'laundries'));
    }

    public function store(Request $request)
    {
        Log::info('Mencoba menambah order baru', ['data' => $request->all()]);
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'laundry_id' => 'required|exists:laundries,id',
            'order_date' => 'required|date',
            'type' => 'required|string',
            'weight' => 'required|numeric',
            'total_price' => 'required|numeric',
            'status' => 'required|string',
            'note' => 'nullable|string'
        ]);

        $order = Order::create($validated);
        Log::info('Berhasil menambah order baru', ['id' => $order->id]);

        return redirect()->route('admin.orders')
            ->with('success', 'Order berhasil ditambahkan');
    }

    public function edit(Order $order)
    {
        Log::info('Mengakses halaman edit order', ['id' => $order->id]);
        $customers = Customer::all();
        $laundries = Laundry::all();
        return view('admin.editorder', compact('order', 'customers', 'laundries'));
    }

    public function update(Request $request, Order $order)
    {
        Log::info('Mencoba update order', [
            'id' => $order->id,
            'data' => $request->all()
        ]);

        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'laundry_id' => 'required|exists:laundries,id',
            'order_date' => 'required|date',
            'type' => 'required|string',
            'weight' => 'required|numeric',
            'total_price' => 'required|numeric',
            'status' => 'required|string',
            'note' => 'nullable|string'
        ]);

        $order->update($validated);
        Log::info('Berhasil update order', ['id' => $order->id]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Order berhasil diperbarui');
    }

    public function destroy(Order $order)
    {
        Log::info('Mencoba hapus order', ['id' => $order->id]);
        $order->delete();
        Log::info('Berhasil hapus order', ['id' => $order->id]);

        return redirect()->route('admin.orders')
            ->with('success', 'Order berhasil dihapus');
    }
}
