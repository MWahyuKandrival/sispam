<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = Pelanggan::with(['petugas', 'currentTransaksi'])->latest()->get();
        // dd($pelanggan[1]->petugas->name);
        return view('pelanggan.index', [
            'pelanggan' => $pelanggan,
            'title' => "List Pelanggan - SISPAM",
            'nav_title' => 'pelanggan',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(User::where('role', '!=', 'Admin')->get());
        return view('pelanggan.create', [
            'title' => "Tambah Pelanggan - SISPAM",
            'petugas' => User::where('role', '!=', 'Admin')->get(),
            'nav_title' => 'pelanggan',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|max:20|unique:pelanggans',
            'name' => 'required|max:255',
            'alamat' => 'required|max:255',
            'no_telp' => 'required|max:255',
            'status' => 'required|max:255',
            'id_user' => 'max:20',
        ]);

        Pelanggan::create($validatedData);
        return redirect('/admin/pelanggan')->with('success', 'Pelanggan Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(Pelanggan $pelanggan)
    {
        return view('pelanggan.detail', [
            'title' => "Detail pelanggan - SISPAM",
            'nav_title' => 'pelanggan',
            'pelanggan' => $pelanggan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggan $pelanggan)
    {
        // dd($pelanggan);
        return view('pelanggan.edit', [
            'pelanggan' => $pelanggan,
            'title' => "Edit Pelanggan - SISPAM",
            'petugas' => User::where('role', '!=', 'Admin')->get(),
            'nav_title' => 'pelanggan',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validatedData = $request->validate([
            'id' => 'required|max:20|unique:pelanggans,id,'.$pelanggan->id,
            'name' => 'required|max:255',
            'alamat' => 'required|max:255',
            'no_telp' => 'required|max:255',
            'status' => 'required|max:255',
            'id_user' => 'max:20',
        ]);

        Pelanggan::where("id", $pelanggan->id)->update($validatedData);
        return redirect('/admin/pelanggan')->with('success', 'Pelanggan Berhasil Ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggan $pelanggan)
    {
        Pelanggan::destroy($pelanggan->id);

        return redirect('/admin/pelanggan')->with('success', 'Pelanggan berhasil dihapus');
    }

    public function getPemakaian(Pelanggan $pelanggan)
    {
        // dd($pelanggan);
        $data = Transaksi::select("pemakaian")->where("id_pelanggan", $pelanggan->id)->latest()->first();
        
        return response()->json($data);
    }

    
}
