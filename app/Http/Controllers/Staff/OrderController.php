<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function staffOrders()
    {
        Log::info('Staff mengakses halaman daftar order');
        $orders = Order::with(['customer', 'laundry'])
            ->latest('order_date')
            ->get();
        return view('staff.orders', compact('orders'));
    }
}
