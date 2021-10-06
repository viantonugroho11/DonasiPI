<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Kategori;
use App\Traits\KategoriNav;
class ArtikelController extends Controller
{
    use KategoriNav;
    //
    public function index()
    {
        $kategori=$this->NavKategori();
        $artikel=Artikel::latest()->limit(2)->get();
        $artikel1=Artikel::leftjoin('admins','admins.id','artikels.id_admin')
        ->select('artikels.*','admins.name as AdmNama')->latest()->paginate(12);
        $kategori1=Kategori::all();
        return view('user.artikel.index',compact(['kategori','artikel','artikel1','kategori1']));
    }
    public function artikelkategori(Request $request)
    {
        $cari = $request->kategori;
        if($cari=='all'){
            return redirect()->route('artikeluser');
        }
        $kategori=$this->NavKategori();
        $artikel=Artikel::latest()->limit(2)->get();
        $kategori1=Kategori::all();
        $artikel1=Artikel::where('id_kategori','=',$cari)->latest()->paginate(12);
        return view('user.artikel.index',compact(['kategori','artikel','artikel1','kategori1']));
    }
    public function show($id)
    {
        $kategori=$this->NavKategori();
        $artikel=Artikel::latest()->limit(2)->get();
        $artikel1=Artikel::leftjoin('admins','admins.id','artikels.id_admin')
        ->select('artikels.*','admins.name as AdmNama')
        ->where('artikels.id','=',$id)->first();
        return view('user.artikel.show',compact(['kategori','artikel','artikel1']));
    }
}
