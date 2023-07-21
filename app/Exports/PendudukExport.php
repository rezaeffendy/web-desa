<?php

namespace App\Exports;

use App\Models\Penduduk;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class PendudukExport implements FromView
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $penduduk = Penduduk::all();
        return view('export.penduduk', compact('penduduk'));
    }
}
