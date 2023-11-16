<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;

class SalesExportToday implements FromView
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return Sale::all();
    // }

    public function view(): View
    {
        $today = Carbon::now()->toDateString();
        $data['sales'] = Sale::whereDate('created_at', $today)->orderBy('amount', 'desc')->get();
        $data['total'] = Sale::whereDate('created_at', $today)->sum('amount');
        return view('dashboard.xlsx.sales-today-file', $data);
    }
}
