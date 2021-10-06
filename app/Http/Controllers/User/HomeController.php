<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Artikel;
use App\Models\Program;
use App\Models\Transaksi;
use DB;
use Auth;
use App\Traits\KategoriNav;
use Carbon\Carbon;
class HomeController extends Controller
{
    use KategoriNav;
    //

    public function index()
    {
        $kategori=$this->NavKategori();
        // $kategori=$this->Kategori1();
        $kategori1=Kategori::latest()->limit(3)->get();
        $artikel=Artikel::latest()->limit(2)->get();
        // $program=Program::leftjoin('transaksis','transaksis.id_program','programs.id')
        // ->select('programs.*','transaksis.nominal as TrNominal')->
        // limit(3)->get();
        $program=Program::where('batas','>=',Carbon::now()->format('Y/m/d'))->latest()->limit(4)->get();
        $program1=Program::where('batas','>=',Carbon::now()->format('Y/m/d'))->limit(4)->get();

        // db::RAW('if(SUM(transaksis.nominal) is null,null,SUM(transaksis.nominal))
        // as TrNominal')
        // foreach($program as $pr){
        //     $jumlah=Transaksi::where('id_program','=',$pr->id)->sum('nominal');
        // }
        // dd($pr);
        return view('user.home',compact(['kategori','artikel','program','program1','kategori1']));
    }
        public function indexKategori()
    {
        $kategori=$this->NavKategori();
        // $kategori=$this->Kategori1();
        $kategori1=Kategori::latest()->get();
        $artikel=Artikel::latest()->limit(2)->get();
        // $program=Program::leftjoin('transaksis','transaksis.id_program','programs.id')
        // ->select('programs.*','transaksis.nominal as TrNominal')->
        // limit(3)->get();
        // $program=Program::where('batas','>=',Carbon::now()->format('Y/m/d'))->latest()->limit(4)->get();

        // db::RAW('if(SUM(transaksis.nominal) is null,null,SUM(transaksis.nominal))
        // as TrNominal')
        // foreach($program as $pr){
        //     $jumlah=Transaksi::where('id_program','=',$pr->id)->sum('nominal');
        // }
        // dd($pr);
        return view('user.indexkategori',compact(['kategori','artikel','kategori1']));
    }
}
