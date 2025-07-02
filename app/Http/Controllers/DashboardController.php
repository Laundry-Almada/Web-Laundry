<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Laundry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $totalOrders = Order::count();
            $totalLaundries = Laundry::count();
            $totalCustomers = User::where('role', 'customer')->count();
            $pendingOrders = Order::where('status', 'pending')->count();
            $totalRevenue = Order::sum('total_price'); 
            $recentOrders = Order::with(['customer', 'service'])->latest('order_date')->take(5)->get();

            return view('admin.dashboard', compact(
                'totalOrders',
                'totalLaundries',
                'totalCustomers',
                'pendingOrders',
                'totalRevenue',
                'recentOrders'
            ));
        } elseif ($user->role === 'staff') {
            return $this->staffDashboard();
        }

        abort(403, 'Unauthorized');
    }


    public function staffDashboard()
    {
        $recentOrders = Order::with(['customer', 'laundry'])
            ->latest('order_date')
            ->take(5)
            ->get();
        return view('staff.dashboard', compact('recentOrders'));
    }
}
