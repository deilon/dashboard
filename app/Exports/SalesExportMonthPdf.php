<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class SalesExportMonthPdf implements FromCollection
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
        $data['sales'] = Sale::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->orderBy('amount', 'desc')
            ->get();
        $data['total'] = Sale::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('amount');
        return view('pdf.sales-pdf-month', $data);
    }
}
