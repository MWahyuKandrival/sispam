<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index', [
            'title' => "List Petugas - SISPAM",
            'nav_title' => 'dashboard',
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
     * @param  \App\Models\Harga  $harga
     * @return \Illuminate\Http\Response
     */
    public function show(Harga $harga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Harga  $harga
     * @return \Illuminate\Http\Response
     */
    public function edit(Harga $harga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Harga  $harga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Harga $harga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Harga  $harga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Harga $harga)
    {
        //
    }
}
