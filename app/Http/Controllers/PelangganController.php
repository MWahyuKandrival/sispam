<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PelangganController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'title' => "Home",
        ]);
    }

    public function tagihan()
    {
        return view('home.tagihan', [
            'title' => "Home",
        ]);
    }

    public function getTagihan(Pelanggan $pelanggan)
    {
        
    }

    public function pengaduan()
    {
        return view('home.pengaduan', [
            'title' => "Home",
        ]);
    }
}
