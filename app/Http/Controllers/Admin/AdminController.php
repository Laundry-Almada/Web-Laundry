<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Laundry;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        try {
            $totalCustomers = Customer::count();
            $totalLaundries = Laundry::count();
            $totalOrders = Order::count();
            $totalServices = Service::count() ?? 0;

            // Statistik order berdasarkan status
            $pendingOrders = Order::where('status', 'pending')->count();
            $processingOrders = Order::where('status', 'processing')->count();
            $readyPickedOrders = Order::where('status', 'ready_picked')->count();
            $completedOrders = Order::where('status', 'completed')->count();

            // Pendapatan total
            $totalRevenue = Order::where('status', 'completed')->sum('total_price');

            // Order terbaru (5 terakhir)
            $recentOrders = Order::with(['customer', 'laundry'])
                ->latest()
                ->take(5)
                ->get();

            // Data untuk grafik order per bulan (6 bulan terakhir)
            $sixMonthsAgo = Carbon::now()->subMonths(6)->startOfMonth();
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;

            // Inisialisasi array untuk 6 bulan terakhir
            $monthlyOrdersData = [];
            $monthlyRevenueData = [];

            // Generate data untuk 6 bulan terakhir
            for ($i = 0; $i < 6; $i++) {
                $date = Carbon::create($currentYear, $currentMonth, 1)->subMonths($i);
                $month = $date->month;
                $year = $date->year;

                // Hitung total order untuk bulan ini
                $orderCount = Order::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->count();

                // Hitung total pendapatan untuk bulan ini
                $revenue = Order::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->where('status', 'completed')
                    ->sum('total_price');

                $monthlyOrdersData[$month] = $orderCount;
                $monthlyRevenueData[$month] = $revenue;
            }

            // Urutkan data berdasarkan bulan
            ksort($monthlyOrdersData);
            ksort($monthlyRevenueData);

            // Data untuk grafik status order
            $orderStatusData = [
                'pending' => $pendingOrders,
                'processing' => $processingOrders,
                'ready_picked' => $readyPickedOrders,
                'completed' => $completedOrders
            ];

            return view('admin.dashboard', compact(
                'totalCustomers',
                'totalLaundries',
                'totalOrders',
                'totalServices',
                'pendingOrders',
                'processingOrders',
                'readyPickedOrders',
                'completedOrders',
                'totalRevenue',
                'recentOrders',
                'monthlyOrdersData',
                'monthlyRevenueData',
                'orderStatusData'
            ));
        } catch (\Exception $e) {
            // Jika terjadi error, set semua variabel ke 0
            $totalCustomers = 0;
            $totalLaundries = 0;
            $totalOrders = 0;
            $totalServices = 0;
            $pendingOrders = 0;
            $processingOrders = 0;
            $readyPickedOrders = 0;
            $completedOrders = 0;
            $totalRevenue = 0;
            $recentOrders = collect();
            $monthlyOrdersData = array_fill(1, 12, 0);
            $monthlyRevenueData = array_fill(1, 12, 0);
            $orderStatusData = [
                'pending' => 0,
                'processing' => 0,
                'ready_picked' => 0,
                'completed' => 0
            ];

            return view('admin.dashboard', compact(
                'totalCustomers',
                'totalLaundries',
                'totalOrders',
                'totalServices',
                'pendingOrders',
                'processingOrders',
                'readyPickedOrders',
                'completedOrders',
                'totalRevenue',
                'recentOrders',
                'monthlyOrdersData',
                'monthlyRevenueData',
                'orderStatusData'
            ));
        }
    }
}
