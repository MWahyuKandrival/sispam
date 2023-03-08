<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\Harga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('petugass.index', [
            'title' => "List Petugas - SISPAM",
            'nav_title' => 'dashboard',
        ]);
    }

    //Pelanggan
    public function pelanggan()
    {
        // dd(Auth::id());
        $pelanggan = Pelanggan::where('id_user', Auth::id())->with(['petugas', 'currentTransaksi'])->latest()->get();
        // dd($pelanggan);
        return view('pelanggan.index', [
            'pelanggan' => $pelanggan,
            'title' => "List Pelanggan - SISPAM",
            'nav_title' => 'pelanggan',
        ]);
    }

    public function show_pelanggan(Pelanggan $pelanggan)
    {
        return view('pelanggan.detail', [
            'title' => "Detail pelanggan - SISPAM",
            'nav_title' => 'pelanggan',
            'pelanggan' => $pelanggan,
        ]);
    }

    //Pelanggan
    public function transaksi()
    {
        $transaksi = Transaksi::where('id_user', Auth::id())->with(['petugas', 'pelanggan'])->latest()->get();
        // dd($transaksi);
        return view('transaksi.index', [
            'transaksi' => $transaksi,
            'title' => "List Transaksi - SISPAM",
            'nav_title' => 'transaksi',
        ]);
    }

    public function show_transaksi(Pelanggan $pelanggan)
    {
        return view('pelanggan.detail', [
            'title' => "Detail pelanggan - SISPAM",
            'nav_title' => 'transaksi',
            'pelanggan' => $pelanggan,
        ]);
    }

    public function create_transaksi()
    {
        return view('transaksi.create', [
            'petugas' => User::where("role", "!=", "Admin")->orderBy('name', 'asc')->get(),
            'harga' => Harga::get(),
            'pelanggan' => Pelanggan::where("status", "!=", "Non-Active")->orderBy('name', 'asc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
