<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Auth;
class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artikel=Artikel::latest()->get();
        return view('admin.artikel.index',compact('artikel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori=Kategori::all();
        return view('admin.artikel.add',compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'     => 'required',
            'foto_sampul'  => 'required|image|mimes:png,jpg,jpeg',
            'detail'=>'required',
            'kategori'=>'required'
        ]);
        $image = $request->file('foto_sampul');
        $image->storeAs('public/PhotoArtikel/', $image->hashName());
        $artikel = artikel::create([
            'nama'     => $request->nama,
            'foto'     => $image->hashname(),
            'detail'     => $request->detail,
            'detail_singkat'     => $request->detail_singkat,
            'id_kategori'     => $request->kategori,
            'id_admin'=>Auth::user()->id
        ]);
        if($artikel){
            return redirect()->route('artikel.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('artikel.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $kategori=Kategori::all();
        $artikel=Artikel::findorfail($id);
        return view('admin.artikel.edit',compact(['kategori','artikel']));
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
        $this->validate($request, [
            'nama'     => 'required',
            'detail'=>'required',
            'kategori'=>'required'
        ]);
        $artikel=artikel::FindOrFail($id);
        if($request->file('foto_sampul') == "") {
            $artikel->update([
                'nama'     => $request->nama,
                'detail'     => $request->detail,
                'detail_singkat'     => $request->detail_singkat,
                'id_kategori'     => $request->kategori,
                'id_admin'=>Auth::user()->id
            ]);
        }else{
            Storage::disk('local')->delete('public/PhotoArtikel/'.$artikel->foto);
            $image = $request->file('foto_sampul');
            $image->storeAs('public/PhotoArtikel/', $image->hashName());
            $artikel->update([
                'foto'     => $image->hashname(),
                'nama'     => $request->nama,
                'detail'     => $request->detail,
                'detail_singkat'     => $request->detail_singkat,
                'id_kategori'     => $request->kategori,
                'id_admin'=>Auth::user()->id
            ]);
        }
        if($artikel){
            return redirect()->route('artikel.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('artikel.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);
        Storage::disk('local')->delete('public/PhotoArtikel/'.$artikel->foto);
        $artikel->delete();
        if($artikel){
           return redirect()->route('artikel.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
          return redirect()->route('artikel.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
