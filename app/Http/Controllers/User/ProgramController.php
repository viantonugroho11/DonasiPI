<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Artikel;
use App\Models\Program;
use App\Traits\KategoriNav;
use Carbon\Carbon;
class ProgramController extends Controller
{
    use KategoriNav;
    //
    public function index($id)
    {
        $idkategori=Kategori::where('nama','=',$id)->first();
        $kategori=$this->NavKategori();
        $artikel=Artikel::latest()->limit(2)->get();
        $program=Program::where('batas','>=',Carbon::now()->format('Y/m/d'))->where('id_kategori','=',$idkategori->id)
        ->latest()->paginate(8);
        return view('user.program',compact(['kategori','artikel','program']));
    }
    public function show($id)
    {
        $kategori=$this->NavKategori();
        $artikel=Artikel::latest()->limit(2)->get();
        $program=Program::where('id','=',$id)->first();
        return view('user.program-single',compact(['kategori','artikel','program']));
    }

}
