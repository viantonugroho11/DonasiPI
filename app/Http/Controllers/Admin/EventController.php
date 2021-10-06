<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $event=Event::latest()->get();
        return view('admin.event.index',compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $kategori=Kategori::all();
        return view('admin.event.add',compact('kategori'));
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
        $this->validate($request, [
            'nama'     => 'required',
            'foto_sampul'  => 'required|image|mimes:png,jpg,jpeg',
            'detail'=>'required',
            'tgl_pelaksaan'=>'required',
            'bts_daftar'=>'required',
            'bts_peserta'=>'required'
        ]);
        $image = $request->file('foto_sampul');
        $image->storeAs('public/PhotoEvent/', $image->hashName());
        $event = Event::create([
            'nama'     => $request->nama,
            'foto'     => $image->hashname(),
            'detail'     => $request->detail,
            'tanggal_pelaksana'     => date('Y/m/d', strtotime($request->tgl_pelaksaan)),
            'batas_tanggal'     => date('Y/m/d', strtotime($request->bts_daftar)),
            'batas_peserta'     => $request->bts_peserta
        ]);
        if($event){
            //redirect dengan pesan sukses
            return redirect()->route('event.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('event.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $event=Event::findorfail($id);
        return view('admin.event.show',compact('event'));
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
        $event=Event::findorfail($id);
        return view('admin.event.edit',compact('event'));
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
        //
        $this->validate($request, [
            'nama'     => 'required',
            'detail'=>'required',
            'tgl_pelaksaan'=>'required',
            'bts_daftar'=>'required',
            'bts_peserta'=>'required'
        ]);
        $event=Event::FindOrFail($id);
        if($request->file('foto_sampul') == "") {
            $event->update([
                'nama'     => $request->nama,
                // 'foto'     => $image->hashname(),
                'detail'     => $request->detail,
                'tanggal_pelaksana'     => date('Y/m/d', strtotime($request->tgl_pelaksaan)),
                'batas_tanggal'     => date('Y/m/d', strtotime($request->bts_daftar)),
                'batas_peserta'     => $request->bts_peserta
            ]);
        }
        else{
            //hapus data foto lama
            Storage::disk('local')->delete('public/PhotoEvent/'.$event->foto);
            //simpan kembali
            $image = $request->file('foto_sampul');
            $image->storeAs('public/PhotoEvent/', $image->hashName());
            $event->update([
                'nama'     => $request->nama,
                'foto'     => $image->hashname(),
                'detail'     => $request->detail,
                'tanggal_pelaksana'     => date('Y/m/d', strtotime($request->tgl_pelaksaan)),
                'batas_tanggal'     => date('Y/m/d', strtotime($request->bts_daftar)),
                'batas_peserta'     => $request->bts_peserta
            ]);
        }
        if($event){
            //redirect dengan pesan sukses
            return redirect()->route('event.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('event.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $event = Event::findOrFail($id);
        Storage::disk('local')->delete('public/PhotoEvent/'.$event->foto);
        $event->delete();
        if($event){
           return redirect()->route('event.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
          return redirect()->route('event.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
