<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Laundry;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Middleware auth agar hanya user login yang bisa akses
        $this->middleware('auth');
    }

    public function index()
    {
        $totalOrders = Order::count();
        $totalLaundries = Laundry::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $pendingOrders = Order::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalLaundries',
            'totalCustomers',
            'pendingOrders'
        ));
    }
}
