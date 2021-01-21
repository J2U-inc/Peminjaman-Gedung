<?php

namespace App\Http\Controllers;

use App\Gedung;
use App\Lembaga;
use App\Peminjaman;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PeminjamanController extends Controller
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
        $user = Auth::user();
        if($user->is_admin==1){
            $peminjaman = Peminjaman::with('gedung')->latest()->get();
            // $peminjaman = DB::table('peminjaman')
            // ->select('gedung.id as gedung_id', 'gedung.nama_gedung', 'peminjaman.*')
            // ->join('gedung', 'gedung.id', '=', 'peminjaman.gedung_id')
            // // ->join('lembaga' , 'lembaga.id', '=' , 'peminjaman.lembaga_id')
            // ->orderBy('created_at','desc')
            // ->get();
        }else{
            $peminjaman = Peminjaman::with('gedung')
                ->where('user_id', $user->id)
                ->latest()
                ->get();
            // $peminjaman = DB::table('peminjaman')
            // ->select('gedung.id as gedung_id', 'gedung.nama_gedung', 'peminjaman.*')
            // ->join('gedung', 'gedung.id', '=', 'peminjaman.gedung_id')
            // // ->join('lembaga' , 'lembaga.id', '=' , 'peminjaman.lembaga_id')
            // ->where('user_id', Auth::user()->id)
            // ->orderBy('created_at','desc')
            // ->get();
        }

        // $peminjaman = Peminjaman::All()->join('gedung' , 'gedung.id', '=' , 'peminjaman.gedung_id')->select('peminjaman.*','gedung.nama');
        $gedung = Gedung::All();

        // $lembaga = Lembaga::All();
        // return $peminjaman;
        return view('admin_page.data_peminjaman', compact('peminjaman'));
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
        return view('admin_page.tambah_data_peminjaman', compact('gedung', 'user'));
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
            'user_id' => 'required',
            'nama_peminjam' => 'required',
            'keperluan' => 'required',
            'lembaga' => 'required',
            'datetimes' => 'required',
            'surat_peminjaman' => 'required',
        ]);


        $tanggal = explode(" - ", $request->datetimes);
        // dd($tanggal);
        if($tanggal[0] < Carbon::now()){
            return redirect('/admin/peminjaman/create')->with('warning',' Tidak bisa meminjam sebelum hari ini !');
        }

                            $cek = Peminjaman::where([
                                ['gedung_id', '=', $request->gedung_id],
                                ['status', '!=', '0'],
                                ['awal_pinjam', '<=', $tanggal[0]],
                                ['akhir_pinjam', '>=', $tanggal[1]],
                            ])
                            // ->whereBetween('awal_pinjam', $tanggal)
                            // ->orWhere([
                            //     ['gedung_id', '=', $request->gedung_id],
                            //     ['status', '!=', '0'],
                            // ])
                            // ->orWhereBetween('akhir_pinjam', $tanggal)
                            // ->where([
                            //     ['awal_pinjam', '<=', $tanggal[0]],
                            //     ['akhir_pinjam', '>=', $tanggal[1]],
                            // ])
                            ->get();


        if($cek->isNotEmpty()){
            return redirect('/admin/peminjaman/create')->with('warning','Gedung tidak dapat dipinjam !');
        }


        $surat_peminjaman = null;
        if ($request->surat_peminjaman) {
            $surat_peminjaman = $request->surat_peminjaman->getClientOriginalName() . '-' . time()
                . '.' . $request->surat_peminjaman->extension();
            $request->surat_peminjaman->move(public_path('surat'), $surat_peminjaman);
        }
        // dd($request->datetimes);


        $peminjaman = new Peminjaman();
        $peminjaman->gedung_id = $request->gedung_id;
        $peminjaman->user_id = $request->user_id;
        // $peminjaman->nama_peminjam = $request->nama_peminjam;
        $peminjaman->keperluan = $request->keperluan;
        $peminjaman->lembaga = $request->lembaga;
        $peminjaman->awal_pinjam = $tanggal[0];
        $peminjaman->akhir_pinjam = $tanggal[1];
        $peminjaman->surat_peminjaman = $surat_peminjaman;
        // dd($user->name);
        $peminjaman->save();

        Mail::raw('Pengajuan Peminjaman dari '.$peminjaman->user->name.' ('.$peminjaman->lembaga.')'.' telah masuk, silahkan cek pada menu Data Peminjaman.',
            function ($message) use($peminjaman) {

                $message->from($peminjaman->user->email, $peminjaman->user->name);


                $message->to('sipegaa@gmail.com', 'Admin Sistem Peminjaman Gedung');

                $message->subject('Pengajuan Peminjaman Gedung');

        });


        return redirect('/admin/peminjaman')->with('success','Data Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::with('gedung', 'user')
                                ->find($id);
        // $peminjaman = Peminjaman::find($id)
        //     // ->select('gedung.id as gedung_id', 'gedung.nama_gedung', 'peminjaman.*', 'users.nim', 'users.email', 'users.nohp')
        //     ->where('peminjaman.id', '=', $id)
        //     ->join('gedung', 'gedung.id', '=', 'peminjaman.gedung_id')
        //     ->join('users','peminjaman.user_id', '=', 'users.id')
        //     // ->join('lembaga' , 'lembaga.id', '=' , 'peminjaman.lembaga_id')
        //     ->get();
        // return $peminjaman;
        $gedung = Gedung::All();
        $user = User::All();
        return view('admin_page.lihat_data_peminjaman', compact('peminjaman', 'gedung', 'user'));
    }

    public function lihatriwayat($id)
    {
        $peminjaman = Peminjaman::with('gedung', 'user')
                                ->find($id);
        // $peminjaman = Peminjaman::find($id)
        //     // ->select('gedung.id as gedung_id', 'gedung.nama_gedung', 'peminjaman.*', 'users.nim', 'users.email', 'users.nohp')
        //     ->where('peminjaman.id', '=', $id)
        //     ->join('gedung', 'gedung.id', '=', 'peminjaman.gedung_id')
        //     ->join('users','peminjaman.user_id', '=', 'users.id')
        //     // ->join('lembaga' , 'lembaga.id', '=' , 'peminjaman.lembaga_id')
        //     ->get();
        // return $peminjaman;
        $gedung = Gedung::All();
        $user = User::All();
        return view('admin_page.lihat_riwayat_peminjaman', compact('peminjaman', 'gedung', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $peminjaman = Peminjaman::find($id)
        //     ->select('gedung.id as gedung_id', 'gedung.nama_gedung', 'peminjaman.*')
        //     ->where('peminjaman.id', '=', $id)
        //     ->join('gedung', 'gedung.id', '=', 'peminjaman.gedung_id')
        //     ->get();
        $peminjaman = Peminjaman::with('gedung', 'user')
        ->find($id);

        $datetimes = array($peminjaman->awal_pinjam, $peminjaman->akhir_pinjam);
        $tanggal = implode(" - ", $datetimes);
        // dd($tanggal);
        // dd($peminjaman);
        $gedung = Gedung::All();
        $user = User::All();
        return view('admin_page.edit_data_peminjaman', compact('peminjaman', 'gedung', 'user', 'tanggal'));
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
        // dd($request);
        $request->validate([
            'gedung_id' => 'required',
            // 'user_id' => 'required',
            'keperluan' => 'required',
            'lembaga' => 'required',
            'datetimes' => 'required',
            // 'surat_peminjaman' => 'required',
        ]);



        // dd($request->datetimes);
        $tanggal = explode(" - ", $request->datetimes);
        $peminjaman = Peminjaman::find($id);
        // dd($peminjaman);
        $peminjaman->gedung_id = $request->gedung_id;
        // $peminjaman->user_id = $request->user_id;
        // $peminjaman->nama_peminjam = $request->nama_peminjam;
        $peminjaman->keperluan = $request->keperluan;
        $peminjaman->lembaga = $request->lembaga;
        $peminjaman->awal_pinjam = $tanggal[0];
        $peminjaman->akhir_pinjam = $tanggal[1];

        $surat_peminjaman = null;
        if ($request->surat_peminjaman) {
            $surat_peminjaman = $request->surat_peminjaman->getClientOriginalName() . '-' . time()
                . '.' . $request->surat_peminjaman->extension();
            $request->surat_peminjaman->move(public_path('surat'), $surat_peminjaman);
            $peminjaman->surat_peminjaman = $surat_peminjaman;
        }

        $peminjaman->save();

        return redirect('/admin/peminjaman')->with('success', 'Data berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Peminjaman::destroy($id);
        return redirect('/admin/peminjaman')->with('success','Data Berhasil Dihapus !');
    }

    public function persetujuan(Request $request,$id)
    {

        // return $request->all();
        $request->validate([
            'status' => 'required'
        ]);
        $user = User::find($request->user_id);
        $peminjaman = Peminjaman::find($id);
        $peminjaman->status = $request->status;
        $peminjaman->save();



        Mail::raw('Selamat '.$user->name.', Pengajuan peminjaman gedung anda telah diterima. Silahkan mengambil kunci di Bagian Umum Rektorat pada Sub Bagian Tata Usaha dan Rumah Tangga. Terimakasih.',
            function ($message) use($user) {


            $message->to($user->email, $user->name);

            $message->subject('Pengajuan Peminjaman Gedung Diterima');

        });

        return redirect('/admin/peminjaman')->with('success','Pengajuan diterima !');
    }

    public function penolakan(Request $request,$id)
    {

        // return $request->all();
        $request->validate([
            'status' => 'required'
        ]);

        $user = User::find($request->user_id);
        $peminjaman = Peminjaman::find($id);
        $peminjaman->status = $request->status;

        $peminjaman->save();

        Mail::raw('Maaf '.$user->name.', Pengajuan peminjaman gedung anda Di Tolak.',
            function ($message) use($user) {


            $message->to($user->email, $user->name);

            $message->subject('Pengajuan Peminjaman Gedung Ditolak');

        });

        return redirect('/admin/peminjaman')->with('warning','Pengajuan ditolak !');
    }

    public function penyelesaian(Request $request,$id)
    {

        // return $request->all();
        $request->validate([
            'status' => 'required'
        ]);

        $user = User::find($request->user_id);
        $peminjaman = Peminjaman::find($id);
        $peminjaman->status = $request->status;

        $peminjaman->save();

        Mail::raw($user->name.', Proses Peminjaman gedung anda telah Selesai.',
            function ($message) use($user) {


            $message->to($user->email, $user->name);

            $message->subject('Pengajuan Peminjaman Selesai');

        });

        return redirect('/admin/peminjaman')->with('success','Pengajuan Selesai !');
    }

    public function riwayat()
    {
        $peminjaman = Peminjaman::with('gedung')
        ->where('status', 2)
        ->latest()
        ->get();


        // $peminjaman = Peminjaman::All()->join('gedung' , 'gedung.id', '=' , 'peminjaman.gedung_id')->select('peminjaman.*','gedung.nama');
        $gedung = Gedung::All();

        // $lembaga = Lembaga::All();
        // return $peminjaman;
        return view('admin_page.riwayat_peminjaman', compact('peminjaman'));
    }

}
