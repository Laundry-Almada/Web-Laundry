<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Laundry;
use App\Models\Service;
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
        $orders = Order::with(['customer', 'laundry', 'service'])->latest()->get();
        return view('admin.dataorder', compact('orders'));
    }

    public function create()
    {
        Log::info('Mengakses halaman tambah order');
        $services = [
            ['id' => 'kiloan', 'name' => 'Kiloan', 'price' => 7000],
            ['id' => 'express', 'name' => 'Express', 'price' => 10000],
            ['id' => 'satuan', 'name' => 'Satuan', 'price' => 5000],
            ['id' => 'reguler', 'name' => 'Reguler', 'price' => 6000]
        ];
        return view('admin.tambahorder', compact('services'));
    }

    public function store(Request $request)
    {
        Log::info('Mencoba menambah order baru', ['data' => $request->all()]);

        try {
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
                'service_id' => 'required|in:kiloan,express,satuan,reguler',
                'order_date' => 'required|date',
                'weight' => 'required|numeric|min:0.1',
                'total_price' => 'required|numeric|min:0',
                'status' => 'required|string|in:pending,processing,ready_picked,completed',
                'note' => 'nullable|string|max:500'
            ]);

            // Generate unique barcode
            $barcode = 'LAU-' . strtoupper(uniqid());

            // Get service price based on type
            $servicePrices = [
                'kiloan' => 7000,
                'express' => 10000,
                'satuan' => 5000,
                'reguler' => 6000
            ];

            // Calculate total price if not provided
            if (!isset($validated['total_price']) || $validated['total_price'] <= 0) {
                $validated['total_price'] = $servicePrices[$validated['service_id']] * $validated['weight'];
            }

            // Create or find customer
            $customer = Customer::firstOrCreate(
                ['name' => $validated['customer_name']],
                ['name' => $validated['customer_name']]
            );

            // Create or get default laundry
            $laundry = Laundry::firstOrCreate(
                ['name' => 'Default Laundry'],
                [
                    'name' => 'Default Laundry',
                    'address' => 'Default Address',
                    'phone' => '08123456789',
                    'email' => 'default@laundry.com',
                    'status' => 'active'
                ]
            );

            // Create service if it doesn't exist
            $service = Service::firstOrCreate(
                [
                    'laundry_id' => $laundry->id,
                    'name' => ucfirst($validated['service_id'])
                ],
                [
                    'price' => $servicePrices[$validated['service_id']],
                    'description' => 'Layanan ' . ucfirst($validated['service_id'])
                ]
            );

            // Create order
            $order = Order::create([
                'customer_id' => $customer->id,
                'laundry_id' => $laundry->id,
                'service_id' => $service->id,
                'jenis' => ucfirst($validated['service_id']),
                'status' => $validated['status'],
                'barcode' => $barcode,
                'weight' => $validated['weight'],
                'total_price' => $validated['total_price'],
                'note' => $validated['note'] ?? null,
                'order_date' => $validated['order_date']
            ]);

            Log::info('Berhasil menambah order baru', ['id' => $order->id]);

            return redirect()->route('admin.orders')
                ->with('success', 'Order berhasil ditambahkan dengan barcode: ' . $barcode);
        } catch (\Exception $e) {
            Log::error('Gagal menambah order baru', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan order: ' . $e->getMessage());
        }
    }

    public function edit(Order $order)
    {
        Log::info('Mengakses halaman edit order', ['id' => $order->id]);
        $customers = Customer::all();
        $laundries = Laundry::all();
        $services = \App\Models\Service::all();
        return view('admin.editorder', compact('order', 'customers', 'laundries', 'services'));
    }

    public function update(Request $request, Order $order)
    {
        Log::info('Mencoba update order', [
            'id' => $order->id,
            'data' => $request->all()
        ]);

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'laundry_id' => 'required|exists:laundries,id',
            'service_id' => 'required|exists:services,id',
            'order_date' => 'required|date',
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

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', [
            'order' => $order,
            'customers' => Customer::all(),
            'laundries' => Laundry::all()
        ]);
    }
}
