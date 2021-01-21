<?php

namespace App\Http\Controllers;

use App\Gedung;
use App\User;
use Illuminate\Http\Request;
use App\Peminjaman;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //Perlu ini untuk smua controller (autentikasi)
    public function __construct()
    {
        $this->middleware('auth');
    }
    //sampe sini


    public function index()
    {
        $gedung = Gedung::All();
        return view('user_page.index' , compact('gedung'));
    }

    public function profil()
    {
        return view('user_page.profil');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('user_page.index' , compact('user'));
    }

    public function showgedung($id)
    {
        $gedung = Gedung::find($id);
        return view('user_page.show_gedung' , compact('gedung'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user_page.edit_profil' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'email' => 'required',
            'nohp' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->nim = $request->nim;
        $user->email = $request->email;
        $user->nohp = $request->nohp;
        $user->fakultas = $request->fakultas;
        $user->jurusan = $request->jurusan;
        $user->save();

        // dd($user);


        return redirect('/user/profil')->with('success', 'Data berhasil diubah !');
    }

    public function cek()
    {
        $peminjaman = Peminjaman::with('gedung')
                        ->where('status', 1) //diterima
                        ->orWhere('status', 2) //diterima
                        ->get();
        // return $peminjaman;

        // dd($peminjaman);
        $data = ["peminjaman" => $peminjaman];
        return view('user_page.cek_tanggal', $data);
    }

    public function cekgedung($id)
    {
        $peminjaman = Peminjaman::with('gedung')
                        ->where('gedung_id', $id )
                        ->where('status', 1) //diterima
                        ->orWhere('gedung_id', $id) //selesai
                        ->where('status', 2) //diterima
                        ->get();
        // return $peminjaman;

        // dd($peminjaman);
        $data = ["peminjaman" => $peminjaman];
        return view('user_page.cek_tanggal_gedung', $data);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
