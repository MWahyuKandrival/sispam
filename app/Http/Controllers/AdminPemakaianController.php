<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Pemakaian;
use Illuminate\Http\Request;

class AdminPemakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemakaian = Pemakaian::with(['petugas', 'pelanggan'])->latest()->get();
        // dd($pemakaian);
        return view('pemakaian.index', [
            'pemakaian' => $pemakaian,
            'title' => "List Pemakaian - SISPAM",
            'nav_title' => 'pemakaian',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pemakaian.create', [
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
        //Validasi
        $validatedData = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id',
            'id_user' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'biaya_perkubik' => 'required|integer|exists:hargas,harga',
            'biaya_admin' => 'required|integer|exists:hargas,harga',
            'pemakaian_sebelum' => 'required|integer|lte:pemakaian_sekarang',
            'pemakaian_sekarang' => 'required|integer|gte:pemakaian_sebelum',
            'total_tagihan' => 'required|integer',
            'total_pembayaran' => 'required|integer|lte:total_tagihan',
        ]);

        $pemakaian = [
            // 'id'=> "".$request->id_pelanggan."-".
        ];

        //Menentukan urutan id 
        $sequence = Transaksi::where('id_pelanggan', $request->id_pelanggan)->count();
        
        //Pembayaran
        


        //

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

    function pembayaran()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $pemakaian
     * @return \Illuminate\Http\Response
     */
    public function show(Pemakaian $pemakaian)
    {
        $tanggal = $pemakaian->created_at->locale("id");
        $tanggal->settings(['formatFunction' => 'translatedFormat']);
        // dd($tanggal->format('l, j F Y  h:i a'));
        return view('pemakaian.detail', [
            'transaksi' => $pemakaian,
            'tanggal' => $tanggal,
            'title' => "List Transaksi - SISPAM",
            'nav_title' => 'pemakaian',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $pemakaian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemakaian $pemakaian)
    {
        // dd($pemakaian);
        $pemakaian_sebelum = "";
        if (Transaksi::select("pemakaian")->where("id_pelanggan", $pemakaian->id_pelanggan)
            ->where('created_at', '<', $pemakaian->created_at)->latest()->exists()
        ) {
            $pemakaian = Transaksi::select("pemakaian")->where("id_pelanggan", $pemakaian->id_pelanggan)
                ->where('created_at', '<', $pemakaian->created_at)->latest()->first();
            $pemakaian_sebelum = $pemakaian->pemakaian;
        }
        // dd($pemakaian_sebelum);
        return view('pemakaian.edit', [
            'transaksi' => $pemakaian,
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
     * @param  \App\Models\Transaksi  $pemakaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemakaian $pemakaian)
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
        Transaksi::where("id_transaksi", $pemakaian->id_transaksi)->update($data);
        return redirect('/admin/transaksi')->with('success', 'Transaksi Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $pemakaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemakaian $pemakaian)
    {
        Transaksi::destroy($pemakaian->id_transaksi);

        return redirect('/admin/transaksi')->with('success', 'Transaksi berhasil dihapus');
    }

    public function getPemakaian(Pelanggan $pelanggan)
    {
        // dd($pelanggan);
        // $data = Pemakaian::select("pemakaian")->where("id_pelanggan", $pelanggan->id)->latest()->first();
        $data['pemakaian'] = Pemakaian::select("pemakaian", "tanggal")->where("id_pelanggan", $pelanggan->id)->latest()->first();
        $data['hutang'] = Pemakaian::selectRAW("sum(total_tagihan) - sum(total_pembayaran) AS hutang")->where("status", "Hutang")->first();
        // dd(response()->json($data));
        return response()->json($data);
    }

    public function getPemakaianUpdate(Pemakaian $pemakaian)
    {
        dd($pemakaian);
        $data = Pemakaian::select("pemakaian")->where("id_pelanggan", $pemakaian->id_pelanggan)
            ->where('created_at', '<', $pemakaian->created_at)->latest()->first();
        dd($data);
        return response()->json($data);
    }
}
