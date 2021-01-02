<?php

namespace App\Http\Controllers;

use App\Lembaga;
use Illuminate\Http\Request;

class LembagaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lembaga = Lembaga::All();
        return view ('admin_page.data_lembaga' , compact('lembaga'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_page.tambah_data_lembaga');
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
            'nama_lembaga' => 'required|min:2|max:255',
            'tanggal_berdiri' => 'required',
            'level' => 'required',
        ]);

        $lembaga = new Lembaga();
        $lembaga->nama_lembaga = $request->nama_lembaga;
        $lembaga->tanggal_berdiri = $request->tanggal_berdiri;
        $lembaga->level = $request->level;
        $lembaga->save();

        return redirect('/admin/lembaga');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lembaga  $lembaga
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $lembaga = Lembaga::find($id);
        return view('admin_page.lihat_data_lembaga' , compact('lembaga'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lembaga  $lembaga
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lembaga = Lembaga::find($id);
        return view('admin_page.edit_data_lembaga' , ['lembaga' => $lembaga]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lembaga  $lembaga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lembaga' => 'required|min:2|max:255',
            'tanggal_berdiri' => 'required',
            'level' => 'required',
        ]);

        $lembaga = Lembaga::find($id);
        $lembaga->nama_lembaga = $request->nama_lembaga;
        $lembaga->tanggal_berdiri = $request->tanggal_berdiri;
        $lembaga->level = $request->level;
        $lembaga->save();

        return redirect('/admin/lembaga');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lembaga  $lembaga
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lembaga::destroy($id);
        return redirect('/admin/lembaga');
    }
}
