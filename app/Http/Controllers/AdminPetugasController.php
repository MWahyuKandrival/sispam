<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminPetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('petugas.index', [
            'petugas' => User::with(['pelanggan', 'currentPemakaian'])->latest()->get(),
            'title' => "List Petugas - SISPAM",
            'nav_title' => 'petugas',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petugas.create', [
            'title' => "Tambah Petugas - SISPAM",
            'nav_title' => 'petugas',
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
            'id' => 'required|max:20|unique:users',
            'name' => 'required|max:255',
            'password' => 'required|max:255',
            'role' => 'required|max:255',
            'status' => 'required|max:255',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);
        return redirect('/admin/petugas')->with('success', 'Petugas Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('petugas.detail', [
            'title' => "Detail Petugas - SISPAM",
            'nav_title' => 'petugas',
            'petugas' => $user,
        ]);
    }

    public function assign(User $user)
    {
        dd($user->pelanggan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('petugas.edit',[
            'petugas' => $user,
            'title' => "Edit Petugas - SISPAM",
            'nav_title' => 'petugas',
        ]);
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
        $validatedData = $request->validate([
            'id' => 'required|max:20|unique:users,id,'.$user->id,
            'name' => 'required|max:255',
            'password' => 'required|max:255',
            'role' => 'required|max:255',
            'status' => 'required|max:255',
        ]);

        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'role' => $request->role,
            'status' => $request->status,
        ];

        if(!Hash::check($request->old_password, $user->password)){
            // return back()->with("error", "Password Salah");
        }else{
            if($request->new_password != ""){
                $data["password"] = bcrypt($request->new_password);
            }
        }

        // $validatedData['password'] = bcrypt($validatedData['password']);

        User::where("id", $user->id)->update($data);
        return redirect('/admin/petugas')->with('success', 'Petugas Berhasil Ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        
        return redirect('/admin/petugas')->with('success', 'Petugas berhasil dihapus');
    }
}
