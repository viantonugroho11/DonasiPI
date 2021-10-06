<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Transaksi;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Artikel;
use App\Models\Newsletter;
use Auth;

class ProfilController extends Controller
{
    //
    public function index()
    {
        $kategori=Kategori::latest()->limit(4)->get();
        $artikel=Artikel::latest()->limit(2)->get();
        $profil=User::where('id','=',Auth::user()->id)->first();
        $jumlahdonasi=Transaksi::where('id_user','=',Auth::user()->id)->sum('nominal');
        $riwayat=Transaksi::where('id_user','=',Auth::user()->id)->latest()->limit(10)->get();
        $newsletter=Newsletter::where('id_user','=',auth::user()->id)->first();
        return view('user.akun.profil',
        compact(['kategori','artikel','profil','jumlahdonasi','newsletter','riwayat']));
    }
    public function emailnotif(Request $request)
    {
        
        $url=url()->previous();
        // dd($request->all());
        // dd($url);
        $this->validate($request, [
            'email'     => 'required'
        ]);
        $user = User::where('email','=',$request->email)->first();
        if(!$user)
        {
            return redirect($url)->with(['error' => 'Data Tidak Ditemukan!']);
        }
        
        if($user)
        {
            $news=Newsletter::where('id_user','=',$user->id)->first();
            if($news)
            {
                return redirect($url);
            }
            else
            {
                $newsdb=newsletter::create([
                    'id_user'=>$user->id
                ]);
                return redirect($url);
            }
        }

    }
    public function ganti(Request $request)
    {
        $news=Newsletter::where('id_user','=',auth::user()->id)->first();
        if($request->newsletter=="YA"){
            if(!($news))
            {
                $news=newsletter::create([
                    'id_user'=>$user->id
                ]);
            }
        }else{
            if($news)
            {
                $news->delete();
            }
        }
        if(!($request->password)){
            $user = User::where('id','=',Auth::user()->id)->first();
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email
            ]);
        }else{
            $user = User::where('id','=',Auth::user()->id)->first();
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password
            ]);
        }
        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('profiluser')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('profiluser')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
    public function indexFavorit()
    {

    }
    public function saveFavorit()
    {

    }
    public function deleteFavorit()
    {

    }
    public function riwayat()
    {
        $kategori=Kategori::latest()->limit(4)->get();
        $artikel=Artikel::latest()->limit(2)->get();
        $riwayat=Transaksi::leftjoin('programs','programs.id','transaksis.id_program')
        ->select('transaksis.*','programs.nama as PrgNama')
        ->where('transaksis.id_user','=',Auth::user()->id)
        ->where('transaksis.jenis','=','Donasi')->latest()->paginate(20);
        return view('user.akun.riwayat',compact(['kategori','artikel','riwayat']));
    }

}
