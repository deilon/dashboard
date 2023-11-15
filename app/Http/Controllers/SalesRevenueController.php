<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Exports\SalesExport;
use App\Exports\SalesExportCurrentMonth;
use Maatwebsite\Excel\Facades\Excel;

class SalesRevenueController extends Controller
{

    public function index() {
        $data['sales'] = Sale::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->orderBy('amount', 'desc')
            ->paginate(15);
        $data['total'] = Sale::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('amount');
        return view('dashboard.admin.sales', $data);
    }

    public function export() {
        return Excel::download(new SalesExport, 'salesRevenueReport.xlsx');
    }

    public function salesExportCurrentMonth() {
        return Excel::download(new SalesExportCurrentMonth, 'salesRevenueReport-'.now()->format('F-Y').'.xlsx');
    }
}
