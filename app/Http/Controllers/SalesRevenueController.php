<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;

class SalesRevenueController extends Controller
{
    public function index() {
        $data['sales'] = $currentMonthSales = Sale::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->orderBy('amount', 'desc')
            ->paginate(15);
        $data['total'] = Sale::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('amount');
        return view('dashboard.admin.sales', $data);
    }
}
