<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShartController extends Controller
{
    public function lineShart() {
        $sales = Order::selectRaw('DATE(created_at) as date, SUM(totalAmount) as total')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
    
        return response()->json($sales);
    }

    public function topSellingProducts()
    {
        $topProducts = OrderItems::selectRaw('products.productName, SUM(order_items.quantite) as total_sales')
            ->join('products', 'order_items.productID', '=', 'products.productID')
            ->groupBy('products.productName')
            ->orderByDesc('total_sales')
            ->limit(5) // عرض أفضل 5 منتجات فقط
            ->get();

        return response()->json($topProducts);
    }

    public function salesByCategory()
    {
        $salesByCategory = DB::table('order_items')
            ->join('products', 'order_items.productID', '=', 'products.productID')
            ->join('categories', 'products.categorieID', '=', 'categories.categorieID')
            ->select('categories.categorieName', DB::raw('SUM(order_items.quantite * order_items.price) as total_sales'))
            ->groupBy('categories.categorieName')
            ->orderByDesc('total_sales')
            ->get();
    
        return response()->json($salesByCategory);
    }

    public function monthlySales()
    {
        $monthlySales = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(totalAmount) as total_sales')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return response()->json($monthlySales);
    }

    public function topCustomers()
    {
        $topCustomers = Order::join('users', 'orders.customerID', '=', 'users.userID')
            ->selectRaw('users.name, SUM(orders.totalAmount) as total_spent')
            ->groupBy('users.name')
            ->orderByDesc('total_spent')
            ->limit(5) // اختيار أفضل 5 عملاء فقط
            ->get();

        return response()->json($topCustomers);
    }

    public function dailyOrders()
    {
        $dailyOrders = Order::selectRaw('DATE(created_at) as order_date, COUNT(*) as total_orders')
            ->groupBy('order_date')
            ->orderBy('order_date')
            ->get();

        return response()->json($dailyOrders);
    }

    public function weeklySales()
    {
        $currentWeekSales = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('totalAmount');

        $lastWeekSales = Order::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
            ->sum('totalAmount');

        // حساب نسبة الزيادة أو النقصان
        $percentageIncrease = $lastWeekSales > 0 
            ? (($currentWeekSales - $lastWeekSales) / $lastWeekSales) * 100 
            : 100; // إذا لم تكن هناك مبيعات الأسبوع الماضي، اعتبرها زيادة 100%

        return response()->json([
            'weekly_sales' => $currentWeekSales,
            'percentage_increase' => round($percentageIncrease, 2) // تقليل الأرقام العشرية
        ]);
    }

    public function weeklyOrders()
    {
        $currentWeekOrders = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count();

        $lastWeekOrders = Order::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
            ->count();

        // حساب نسبة التغير
        $percentageChange = $lastWeekOrders > 0 
            ? (($currentWeekOrders - $lastWeekOrders) / $lastWeekOrders) * 100 
            : ($currentWeekOrders > 0 ? 100 : 0); // إذا لم تكن هناك طلبات سابقة، اعتبرها زيادة 100%

        return response()->json([
            'weekly_orders' => $currentWeekOrders,
            'percentage_change' => round($percentageChange, 2) // تقليل الأرقام العشرية
        ]);
    }
}
