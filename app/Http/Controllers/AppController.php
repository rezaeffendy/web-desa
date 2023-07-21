<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class AppController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home',
            'berita' => Berita::all()
        ];

        return view('landing.home', $data);
    }
}
