<?php

namespace App\Http\Controllers;

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
        return view('user_page.index');
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
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->nim = $request->nim;
        $user->email = $request->email;
        $user->nohp = $request->nohp;
        $user->save();

        // dd($user);


        return redirect('/user/index')->with('success', 'Data berhasil diubah !');
    }

    public function cek()
    {
        $peminjaman = Peminjaman::with('gedung')
                        ->where('status', 1)
                        ->get();
        // return $peminjaman;
        $data = ["peminjaman" => $peminjaman];
        return view('user_page.cek_tanggal', $data);
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
