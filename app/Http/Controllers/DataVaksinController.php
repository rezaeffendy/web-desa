<?php

namespace App\Http\Controllers;

use App\Models\Vaksin;
use Illuminate\Http\Request;

class DataVaksinController extends Controller
{
    public function __invoke()
    {
        $data = [
            'title' => "Data Vaksin",
            'vaksins' => Vaksin::all()
        ];
        return view('landing.vaksin.index', $data);
    }
}
