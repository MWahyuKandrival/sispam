<?php

namespace App\Http\Controllers;

use App\Models\Mesin;
use Illuminate\Http\Request;

class AdminMesinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("mesin.index", [
            'mesin' => Mesin::get(),
            'title' => "List Mesin - SISPAM",
            'nav_title' => 'mesin',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("mesin.create", [
            'title' => "List Mesin - SISPAM",
            'nav_title' => 'mesin',
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
            'id' => 'required|max:20|unique:mesins',
            'name' => 'required|max:255',
            'status' => 'required|max:255',
            'keterangan' => 'required|max:255',
        ]);

        Mesin::create($validatedData);
        return redirect('/admin/mesin')->with('success', 'Mesin Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mesin  $mesin
     * @return \Illuminate\Http\Response
     */
    public function show(Mesin $mesin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mesin  $mesin
     * @return \Illuminate\Http\Response
     */
    public function edit(Mesin $mesin)
    {
        return view("mesin.edit", [
            'title' => "List Mesin - SISPAM",
            'nav_title' => 'mesin',
            'mesin' => $mesin,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mesin  $mesin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mesin $mesin)
    {
        $validatedData = $request->validate([
            'id' => 'required|max:20|unique:mesins,id,'.$mesin->id,
            'name' => 'required|max:255',
            'status' => 'required|max:255',
            'keterangan' => 'required|max:255',
        ]);

        Mesin::where("id", $mesin->id)->update($validatedData);
        return redirect('/admin/mesin')->with('success', 'Mesin Berhasil Ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mesin  $mesin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mesin $mesin)
    {
        Mesin::destroy($mesin->id);

        return redirect('/admin/mesin')->with('success', 'Mesin berhasil dihapus');
    }
}
