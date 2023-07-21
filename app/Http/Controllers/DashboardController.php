<?php

namespace App\Http\Controllers;

use App\Models\Formulir;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'penduduk' => Penduduk::count(),
            'surat' => Formulir::count()
        ];

        return view('dashboard.index', $data);
    }
}
