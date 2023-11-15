<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class SalesExportCurrentMonth implements FromView
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return Sale::all();
    // }

    // public function query() {
    //     return Sale::query()->whereMonth('created_at', now()->month);
    // }

    public function view(): View
    {
        $data['sales'] = Sale::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->orderBy('amount', 'desc')
            ->paginate(15);
        $data['total'] = Sale::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('amount');
        return view('dashboard.xlsx.sales-current-month', $data);
    }
}
