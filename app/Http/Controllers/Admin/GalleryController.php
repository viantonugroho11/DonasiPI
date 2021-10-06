<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Kategori;
class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery=Gallery::latest()->get();
        return view('admin.gallery.index',compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori=Kategori::all();
        return view('admin.gallery.add',compact('kategori'));
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
            'foto'  => 'required|image|mimes:png,jpg,jpeg',
            'kategori'=>'required'
        ]);
        $image = $request->file('foto');
        $image->storeAs('public/PhotoGallery/', $image->hashName());
        $gallery = Gallery::create([
            'nama'     => $request->nama,
            'foto'     => $image->hashname(),
            'id_kategori'     => $request->kategori,
        ]);
        if($gallery){
            return redirect()->route('gallery.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('gallery.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $gallery=Gallery::findorfail($id);
        return view('admin.gallery.edit',compact(['kategori','gallery']));
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
            'kategori'=>'required'
        ]);
        $gallery=gallery::FindOrFail($id);
        if($request->file('foto') == "") {
            $gallery->update([
                'nama'     => $request->nama,
                'id_kategori'     => $request->kategori,
            ]);
        }else{
            Storage::disk('local')->delete('public/PhotoGallery/'.$gallery->foto);
            $image = $request->file('foto');
            $image->storeAs('public/PhotoGallery/', $image->hashName());
            $gallery->update([
                'foto'     => $image->hashname(),
                'nama'     => $request->nama,
                'id_kategori'     => $request->kategori,
            ]);
        }
        if($artikel){
            return redirect()->route('gallery.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('gallery.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $gallery = Gallery::findOrFail($id);
        Storage::disk('local')->delete('public/PhotoArtikel/'.$gallery->foto);
        $gallery->delete();
        if($gallery){
           return redirect()->route('gallery.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
          return redirect()->route('gallery.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
