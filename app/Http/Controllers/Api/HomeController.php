<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Program;
use App\Models\Artikel;
use Carbon\Carbon;
class HomeController extends Controller
{
    //
    public function index()
    {
        $kategori1=Kategori::where('tipe','=','Umum')->latest()->limit(7)->get();
        $program=Program::where('batas','>=',Carbon::now()->format('Y/m/d'))->with('getTransaksi')->select('id','nama','id_kategori','detail_singkat','batas','nominal','foto')->latest()->limit(5)->get();
        $artikel=Artikel::select('id','nama','id_admin','detail_singkat','foto')->latest()->limit(5)->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Artikel',
            'kategori'=> $kategori1,
            'program' =>$program,
            'artikel' =>$artikel
        ], 200);

    }
    public function kategori()
    {
        $kategori1=Kategori::where('tipe','=','Umum')->latest()->get();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Artikel',
            'kategori'    => $kategori1
        ], 200);
    }
}
