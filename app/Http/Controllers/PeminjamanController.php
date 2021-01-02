<?php

namespace App\Http\Controllers;

use App\Gedung;
use App\Lembaga;
use App\Peminjaman;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peminjaman = DB::table('peminjaman')
        ->select('gedung.id as gedung_id','gedung.nama_gedung' , 'peminjaman.*')
            ->join('gedung' , 'gedung.id', '=' , 'peminjaman.gedung_id')
            // ->join('lembaga' , 'lembaga.id', '=' , 'peminjaman.lembaga_id')
            ->get();
        // $peminjaman = Peminjaman::All()->join('gedung' , 'gedung.id', '=' , 'peminjaman.gedung_id')->select('peminjaman.*','gedung.nama');
        $gedung = Gedung::All();

        // $lembaga = Lembaga::All();

        return view ('admin_page.data_peminjaman' , compact('peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gedung = Gedung::All();
        $user = User::All();
        return view('admin_page.tambah_data_peminjaman' ,compact('gedung', 'user'));
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
            'gedung_id' => 'required',
            // 'user_id' => 'required',
            'nama_peminjam' => 'required',
            'keperluan' => 'required',
            'lembaga' => 'required',
            'datetimes' => 'required',
            'surat_peminjaman' => 'required',
        ]);


        $surat_peminjaman=null;
            if($request->surat_peminjaman){
            $surat_peminjaman = $request->surat_peminjaman->getClientOriginalName() . '-' . time()
                                    . '.' . $request->surat_peminjaman->extension();
            $request->surat_peminjaman->move(public_path('gambar'), $surat_peminjaman);
        }
        // dd($request->datetimes);
        $tanggal= explode(" - ", $request->datetimes);
        $peminjaman = new Peminjaman();
        $peminjaman->gedung_id = $request->gedung_id;
        $peminjaman->user_id = $request->user_id;
        $peminjaman->nama_peminjam = $request->nama_peminjam;
        $peminjaman->keperluan = $request->keperluan;
        $peminjaman->lembaga = $request->lembaga;
        $peminjaman->awal_pinjam = $tanggal[0];
        $peminjaman->akhir_pinjam = $tanggal[1];
        $peminjaman->surat_peminjaman = $surat_peminjaman;

        $peminjaman->save();

        return redirect('/admin/peminjaman');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::find($id)
            ->select('gedung.id as gedung_id','gedung.nama_gedung' , 'peminjaman.*')
            ->where('peminjaman.id','=' , $id)
            ->join('gedung' , 'gedung.id', '=' , 'peminjaman.gedung_id')
            // ->join('lembaga' , 'lembaga.id', '=' , 'peminjaman.lembaga_id')
            ->get();
            // dd($peminjaman);
        $gedung = Gedung::All();
        $user = User::All();
        return view('admin_page.lihat_data_peminjaman' , compact('peminjaman','gedung','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $peminjaman = Peminjaman::find($id)
        ->select('gedung.id as gedung_id','gedung.nama_gedung' , 'peminjaman.*')
        ->where('peminjaman.id','=' , $id)
        ->join('gedung' , 'gedung.id', '=' , 'peminjaman.gedung_id')
        ->get();
        // dd($peminjaman);
        $datetimes=array($peminjaman[0]->awal_pinjam, $peminjaman[0]->akhir_pinjam);
        $tanggal=implode(" - ",$datetimes);
        // dd($tanggal);
        $gedung = Gedung::All();
        $user = User::All();
        return view('admin_page.edit_data_peminjaman' , compact('peminjaman','gedung','user','tanggal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        $request->validate([
            'gedung_id' => 'required',
            // 'user_id' => 'required',
            'nama_peminjam' => 'required',
            'keperluan' => 'required',
            'lembaga' => 'required',
            'datetimes' => 'required',
            'surat_peminjaman' => 'required',
        ]);


        $surat_peminjaman=null;
            if($request->surat_peminjaman){
            $surat_peminjaman = $request->surat_peminjaman->getClientOriginalName() . '-' . time()
                                    . '.' . $request->surat_peminjaman->extension();
            $request->surat_peminjaman->move(public_path('gambar'), $surat_peminjaman);
        }
        // dd($request->datetimes);
        $tanggal= explode(" - ", $request->datetimes);
        $peminjaman = Peminjaman::find($id);
        dd($peminjaman);
        $peminjaman->gedung_id = $request->gedung_id;
        $peminjaman->user_id = $request->user_id;
        $peminjaman->nama_peminjam = $request->nama_peminjam;
        $peminjaman->keperluan = $request->keperluan;
        $peminjaman->lembaga = $request->lembaga;
        $peminjaman->awal_pinjam = $tanggal[0];
        $peminjaman->akhir_pinjam = $tanggal[1];
        $peminjaman->surat_peminjaman = $surat_peminjaman;


        $peminjaman->save();

        return redirect('/admin/peminjaman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gedung::destroy($id);
        return redirect('/admin/peminjaman');
    }
}
