<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Laundry;
use App\Models\Order;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total counts
        $totalCustomers = Customer::count();
        $totalLaundries = Laundry::count();
        $totalOrders = Order::count();
        $totalServices = Service::count();

        // Total revenue (hanya dari order yang completed)
        $totalRevenue = Order::where('status', 'completed')
            ->sum('total_price');

        // Order status counts
        $orderStatusData = [
            'pending' => Order::where('status', 'pending')->count(),
            'washed' => Order::where('status', 'washed')->count(),
            'dried' => Order::where('status', 'dried')->count(),
            'ironed' => Order::where('status', 'ironed')->count(),
            'ready_picked' => Order::where('status', 'ready_picked')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        // Monthly orders data
        $monthlyOrdersData = [];
        $monthlyRevenueData = [];
        $startDate = Carbon::now()->subMonths(2)->startOfMonth();
        $endDate = Carbon::now();

        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $month = $currentDate->format('n'); // 1-12
            $monthlyOrdersData[$month] = Order::whereYear('order_date', $currentDate->year)
                ->whereMonth('order_date', $month)
                ->count();

            $monthlyRevenueData[$month] = Order::whereYear('order_date', $currentDate->year)
                ->whereMonth('order_date', $month)
                ->where('status', 'completed')
                ->sum('total_price');

            $currentDate->addMonth();
        }

        // Recent orders
        $recentOrders = Order::with(['customer', 'laundry'])
            ->latest('order_date')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalCustomers',
            'totalLaundries',
            'totalOrders',
            'totalServices',
            'totalRevenue',
            'orderStatusData',
            'monthlyOrdersData',
            'monthlyRevenueData',
            'recentOrders'
        ));
    }
}
