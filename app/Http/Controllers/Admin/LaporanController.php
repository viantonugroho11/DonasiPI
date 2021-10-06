<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Program;
class LaporanController extends Controller
{
    //
    public function indextransaksi()
    {
        $transaksi=Transaksi::leftjoin('programs','programs.id','transaksis.id_program')
        ->select('transaksis.*','programs.nama as DnsNama')->where('transaksis.jenis','=','Donasi')->latest()->get();
        return view('admin.laporan.transaksi',compact('transaksi'));
    }
    public function indexuser()
    {
        $user=User::all();
        return view('admin.laporan.user',compact('user'));
    }
    public function indexprogram()
    {
        $program=Program::leftjoin('kategoris','kategoris.id','programs.id_kategori')
        ->select('programs.*','kategoris.nama as KtgNama')->latest()->get();
        return view('admin.laporan.program',compact('program'));
    }
}
