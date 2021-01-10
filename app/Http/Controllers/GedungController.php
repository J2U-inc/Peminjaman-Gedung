<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gedung;

class GedungController extends Controller
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
        return view ('admin_page.data_gedung' , compact('gedung'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_page.tambah_data_gedung');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_gedung' => 'required|min:2|max:255',
            'luas' => 'required',
            'kapasitas' => 'required',
            'fungsi' => 'required',
            'deskripsi' => 'required|min:10',
            'foto' => 'mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $imgName=null;
            if($request->foto){
            $imgName = $request->foto->getClientOriginalName() . '-' . time()
                                    . '.' . $request->foto->extension();
            $request->foto->move(public_path('gambar'), $imgName);
        }

        $gedung = new Gedung();
        $gedung->nama_gedung = $request->nama_gedung;
        $gedung->luas = $request->luas;
        $gedung->kapasitas = $request->kapasitas;
        $gedung->fungsi = $request->fungsi;
        $gedung->deskripsi = $request->deskripsi;
        $gedung->foto = $imgName;
        $gedung->save();

        return redirect('/admin/gedung')->with('success','Data Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gedung = Gedung::find($id);
        return view('admin_page.lihat_data_gedung' , compact('gedung'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gedung = Gedung::find($id);
        return view('admin_page.edit_data_gedung' , ['gedung' => $gedung]);
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
            'nama_gedung' => 'required|min:2|max:255',
            'luas' => 'required',
            'kapasitas' => 'required',
            'fungsi' => 'required',
            'deskripsi' => 'required|min:10',
            'foto' => 'mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);



        // $surat_peminjaman = null;
        // if ($request->surat_peminjaman) {
        //     $surat_peminjaman = $request->surat_peminjaman->getClientOriginalName() . '-' . time()
        //         . '.' . $request->surat_peminjaman->extension();
        //     $request->surat_peminjaman->move(public_path('gambar'), $surat_peminjaman);
        //     $peminjaman->surat_peminjaman = $surat_peminjaman;
        // }

        $gedung = Gedung::find($id);

        $gedung->nama_gedung = $request->nama_gedung;
        $gedung->luas = $request->luas;
        $gedung->kapasitas = $request->kapasitas;
        $gedung->fungsi = $request->fungsi;
        $gedung->deskripsi = $request->deskripsi;
        // $gedung->foto = $imgName;
        $imgName=null;
        if($request->foto){
            $imgName = $request->foto->getClientOriginalName() . '-' . time()
                                    . '.' . $request->foto->extension();
            $request->foto->move(public_path('gambar'), $imgName);
            $gedung->foto = $imgName;
        }
        $gedung->save();


        return redirect('/admin/gedung')->with('success', 'Data berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gedung::destroy($id);
        return redirect('/admin/gedung')->with('success','Data Berhasil Dihapus !');
    }
}
