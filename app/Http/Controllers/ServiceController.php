<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function index()
{
    // Ambil data order yang dibutuhkan
    $orders = Order::with('customer', 'laundry', 'service')->get();

    // Kirim data orders ke view
    return view('services', compact('orders'));
}
}
