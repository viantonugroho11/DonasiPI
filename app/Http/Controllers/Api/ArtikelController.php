<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;

class ArtikelController extends Controller
{
    //
    public function index()
    {
        $artikel1=Artikel::latest()->get();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Donasi',
            'data'    => $artikel1
        ], 200);
    }
    public function indexartikel()
    {
        $artikel1=Artikel::where('kategori','=',$id)
        ->latest()->get();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Donasi',
            'data'    => $artikel1
        ], 200);
    }
    public function show($id)
    {
        $artikel1=Artikel::leftjoin('admins','admins.id','artikels.id_admin')
        ->select('artikels.*','admins.name as AdmNama')
        ->where('artikels.id','=',$id)->first();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Artikel',
            'data'    => $artikel1
        ], 200);
    }
}
