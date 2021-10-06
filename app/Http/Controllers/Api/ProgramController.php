<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Transaksi;

class ProgramController extends Controller
{
    //
    public function index($id)
    {
        $program=Program::where('id_kategori','=',$id)
        ->latest()->get();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Program',
            'data'    => $program
        ], 200);
    }
    public function show($id)
    {
        $program=Program::where('id','=',$id)
        ->with('getTransaksi')->first();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Donasi',
            'data'    => $program
        ], 200);
    }
    public function jumlah($id)
    {
        $jumlah=Transaksi::where('id_program','=',$id)->sum('nominal');
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Jumlah',
            'data'    => $jumlah
        ], 200);
    }
    public function indextrans($id)
    {
        $indextr=Transaksi::where('id_program','=',$id)->get();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data transaksi',
            'data'    => $indextr
        ], 200);
    }
}
