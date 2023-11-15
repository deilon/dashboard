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

    public function search(Request $request) {
        $query = $request->input('query');

        $sales = Sale::where('subscription_arrangement', 'like', '%'.$query.'%')
                    ->orWhere('tier_name', 'like', '%'.$query.'%')
                    ->orWhere('payment_method', 'like', '%'.$query.'%')
                    ->orWhere('date', 'like', '%'.$query.'%')
                    ->orWhere('customer_name', 'like', '%'.$query.'%')
                    ->orWhere('amount', 'like', '%'.$query.'%')
                    ->get();

        $output = '';
        foreach($sales as $sale) {
            $output.= "<tr class=\"user-sales-row-".$sale->id."\">
                    <td>".$sale->id."</td>
                    <td>".$sale->subscription_arrangement."</td>
                    <td>".$sale->tier_name."</td>
                    <td>".$sale->payment_method."</td>
                    <td>".$sale->date."</td>
                    <td>".$sale->customer_name."</td>
                    <td>".$sale->amount."</td>
                </tr>";
        }

        return response($output);
    }
}
