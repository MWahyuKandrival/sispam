<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::with(['petugas', 'pelanggan'])->latest()->get();
        // dd($transaksi);
        return view('transaksi.index', [
            'transaksi' => $transaksi,
            'title' => "List Transaksi - SISPAM",
            'nav_title' => 'transaksi',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaksi.create', [
            'petugas' => User::where("role", "!=", "Admin")->orderBy('name', 'asc')->get(),
            'harga' => Harga::get(),
            'pelanggan' => Pelanggan::where("status", "!=", "Non-Active")->orderBy('name', 'asc')->get(),
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
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'id_user' => 'required|exists:users,id',
            'biaya_perkubik' => 'required|integer|exists:hargas,harga',
            'biaya_admin' => 'required|integer|exists:hargas,harga',
            'pemakaian_sebelum' => 'required|integer|lte:pemakaian_sekarang',
            'pemakaian_sekarang' => 'required|integer|gte:pemakaian_sebelum',
            'total_tagihan' => 'required|integer',
            'total_pembayaran' => 'required|integer|lte:total_tagihan',
        ]);

        $sequence = Transaksi::where('id_pelanggan', $request->id_pelanggan)->count();
        $status = ($request->total_pembayaran == $request->total_tagihan) ? "Lunas" : "Hutang";
        $id_transaksi = $request->id_pelanggan . (++$sequence);
        $exist = Transaksi::where('id_transaksi', $id_transaksi)->exists();
        while ($exist) {
            $id_transaksi = $request->id_pelanggan . (++$sequence);
            $exist = Transaksi::where('id_transaksi', $id_transaksi)->exists();
        }
        $data = [
            'id_transaksi' => $id_transaksi,
            'id_pelanggan' => $request->id_pelanggan,
            'id_user' => $request->id_user,
            'biaya_perkubik' => $request->biaya_perkubik,
            'biaya_admin' => $request->biaya_admin,
            'pemakaian' => $request->pemakaian_sekarang,
            'total_tagihan' => $request->total_tagihan,
            'total_pembayaran' => $request->total_pembayaran,
            'status' => $status,
        ];
        Transaksi::create($data);
        return redirect('/admin/transaksi')->with('success', 'Transaksi Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        $tanggal = $transaksi->created_at->locale("id");
        $tanggal->settings(['formatFunction' => 'translatedFormat']);
        // dd($tanggal->format('l, j F Y  h:i a'));
        return view('transaksi.detail', [
            'transaksi' => $transaksi,
            'tanggal' => $tanggal,
            'title' => "List Transaksi - SISPAM",
            'nav_title' => 'transaksi',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        // dd($transaksi);
        $pemakaian_sebelum = "";
        if (Transaksi::select("pemakaian")->where("id_pelanggan", $transaksi->id_pelanggan)
            ->where('created_at', '<', $transaksi->created_at)->latest()->exists()
        ) {
            $pemakaian = Transaksi::select("pemakaian")->where("id_pelanggan", $transaksi->id_pelanggan)
                ->where('created_at', '<', $transaksi->created_at)->latest()->first();
            $pemakaian_sebelum = $pemakaian->pemakaian;
        }
        // dd($pemakaian_sebelum);
        return view('transaksi.edit', [
            'transaksi' => $transaksi,
            'pemakaian_sebelum' => $pemakaian_sebelum,
            'petugas' => User::where("role", "!=", "Admin")->orderBy('name', 'asc')->get(),
            'harga' => Harga::get(),
            'pelanggan' => Pelanggan::where("status", "!=", "Non-Active")->orderBy('name', 'asc')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $validatedData = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'id_user' => 'required|exists:users,id',
            'biaya_perkubik' => 'required|integer|exists:hargas,harga',
            'biaya_admin' => 'required|integer|exists:hargas,harga',
            'pemakaian_sebelum' => 'required|integer|lte:pemakaian_sekarang',
            'pemakaian_sekarang' => 'required|integer|gte:pemakaian_sebelum',
            'total_tagihan' => 'required|integer',
            'total_pembayaran' => 'required|integer|lte:total_tagihan',
        ]);

        $status = ($request->total_pembayaran == $request->total_tagihan) ? "Lunas" : "Hutang";

        $data = [
            'id_pelanggan' => $request->id_pelanggan,
            'id_user' => $request->id_user,
            'biaya_perkubik' => $request->biaya_perkubik,
            'biaya_admin' => $request->biaya_admin,
            'pemakaian' => $request->pemakaian_sekarang,
            'total_tagihan' => $request->total_tagihan,
            'total_pembayaran' => $request->total_pembayaran,
            'status' => $status,
        ];
        Transaksi::where("id_transaksi", $transaksi->id_transaksi)->update($data);
        return redirect('/admin/transaksi')->with('success', 'Transaksi Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        Transaksi::destroy($transaksi->id_transaksi);

        return redirect('/admin/transaksi')->with('success', 'Transaksi berhasil dihapus');
    }

    public function getPemakaianUpdate(Transaksi $transaksi)
    {
        // dd($transaksi);
        $data = Transaksi::select("pemakaian")->where("id_pelanggan", $transaksi->id_pelanggan)
            ->where('created_at', '<', $transaksi->created_at)->latest()->first();
        dd($data);
        return response()->json($data);
    }
}
