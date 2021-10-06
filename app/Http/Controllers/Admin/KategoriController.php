<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kategori=Kategori::latest()->get();
        return view('admin.kategori.index',compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.kategori.add');
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
            'nama'     => 'required'
        ]);
        if($request->file('icon') == "") {
            $Kategori = Kategori::create([
                'nama'     => $request->nama
            ]);
        }else{
            //buat gambar
            $image = $request->file('icon');
            $image->storeAs('public/PhotoKategori/', $image->hashName());
            //selesai itu meet gw mute

            $Kategori = Kategori::create([
                'nama'     => $request->nama,
                'icon'     => $image->hashName()
            ]);
        }
        if($Kategori){
            return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('kategori.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $kategori=Kategori::findorfail($id);
        return view('admin.kategori.edit',compact('kategori'));
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
            'nama'     => 'required'
        ]);
        $Kategori=kategori::findorfail($id);
        if($request->file('icon') == "") {
            $Kategori->update([
                'nama'     => $request->nama
            ]);
        }else{
            Storage::disk('local')->delete('public/PhotoKategori/'.$Kategori->icon);
            $image = $request->file('icon');
            $image->storeAs('public/PhotoKategori/', $image->hashName());
            $Kategori->update([
                'nama'     => $request->nama,
                'icon'     => $image->hashName()
            ]);
        }
        if($Kategori){
            return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('kategori.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $kategori = kategori::findOrFail($id);
        Storage::disk('local')->delete('public/PhotoKategori/'.$Kategori->icon);
        $kategori->delete();
        if($kategori){
           return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
          return redirect()->route('kategori.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
