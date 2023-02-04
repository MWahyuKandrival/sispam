<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use Illuminate\Http\Request;

class AdminHargaController extends Controller
{
    public function index()
    {
        return view('harga.index', [
            'harga' => Harga::get(),
            'title' => "List Harga - SISPAM",
            'nav_title' => 'harga',
        ]);
    }

    public function edit(Harga $harga)
    {
        return view('harga.edit', [
            'title' => "Edit Harga - SISPAM",
            'nav_title' => 'harga',
            'harga' => $harga,
        ]);
    }

    public function update(Request $request, Harga $harga)
    {
        $validatedData = $request->validate([
            'harga' => 'required',
            'keterangan' => 'required|max:255',
        ]);

        Harga::where("id", $harga->id)->update($validatedData);
        return redirect('/admin/harga')->with('success', 'Harga Berhasil Diubah!');
    }
}
