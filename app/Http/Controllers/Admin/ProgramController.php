<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Kategori;
use App\Models\Newsletter;
use App\Mail\NotifEmailMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $program=Program::leftjoin('kategoris','kategoris.id','programs.id_kategori')
        ->select('programs.*','kategoris.nama as KtgNama')->latest()->get();
        return view('admin.program.index',compact('program'));
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
        return view('admin.program.add',compact('kategori'));
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
            'nominal'=>'required',
            'tanggal'=>'required',
            'kategori'=>'required'
        ]);
        $nama   =$request->nama;
        $detail =$request->detail_singkat;
        $nominal=$request->nominal;
        $tanggal=date('Y/m/d', strtotime($request->tanggal));
        $image = $request->file('foto_sampul');
        $image->storeAs('public/PhotoProgram/', $image->hashName());
        $program = Program::create([
            'nama'     => $request->nama,
            'foto'     => $image->hashname(),
            'detail'     => $request->detail,
            'detail_singkat'     => $request->detail_singkat,
            'id_kategori'     => $request->kategori,
            'nominal'=>$request->nominal,
            'batas'=>date('Y/m/d', strtotime($request->tanggal))
        ]);
        $idprogram=$program->id;
        $image=$program->foto;
        $user=Newsletter::leftjoin('users','users.id','newsletters.id_user')->select('users.email as email','users.name as name')->get();
        foreach($user as $item){
            $usernama=$item->name;
            // dd($usernama);
            Mail::to($item->email)->send(new NotifEmailMail($nama,$detail,$nominal,$tanggal,$usernama,$idprogram,$image));
        }
        if($program){
            //redirect dengan pesan sukses
            return redirect()->route('program.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('program.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $program=Program::findorfail($id);
        return view('admin.program.show',compact('program'));
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
        $program=Program::findorfail($id);
        return view('admin.program.edit',compact(['program','kategori']));
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
            'nominal'=>'required',
            'tanggal'=>'required',
            'kategori'=>'required'
        ]);
        $program=Program::FindOrFail($id);
        if($request->file('foto_sampul') == "") {
            $program->update([
                'nama'     => $request->nama,
                'detail'     => $request->detail,
                'detail_singkat'     => $request->detail_singkat,
                'id_kategori'     => $request->kategori,
                'nominal'=>$request->nominal,
                'batas'=>date('Y/m/d', strtotime($request->tanggal))
            ]);
        }else{
            //hapus data foto lama
            Storage::disk('local')->delete('public/PhotoProgram/'.$program->foto);
            //simpan kembali
            $image = $request->file('foto_sampul');
            $image->storeAs('public/PhotoProgram/', $image->hashName());
            $program->update([
                'nama'     => $request->nama,
                'foto'     => $image->hashname(),
                'detail'     => $request->detail,
                'detail_singkat'     => $request->detail_singkat,
                'id_kategori'     => $request->kategori,
                'nominal'=>$request->nominal,
                'batas'=>date('Y/m/d', strtotime($request->tanggal))
            ]);
        }
        if($program){
            //redirect dengan pesan sukses
            return redirect()->route('program.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('program.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $program = Program::findOrFail($id);
        Storage::disk('local')->delete('public/PhotoProgram/'.$program->foto);
        $program->delete();
        if($program){
           return redirect()->route('program.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
          return redirect()->route('program.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
