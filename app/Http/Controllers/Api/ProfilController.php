<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Newsletter;
use App\Models\Transaksi;
use Auth;
class ProfilController extends Controller
{
    //
    public function index()
    {
        $profil=User::where('id','=',Auth::user()->id)->first();
        $jumlahdonasi=Transaksi::where('id_user','=',Auth::user()->id)->sum('nominal');
        $riwayat=Transaksi::where('id_user','=',Auth::user()->id)->latest()->limit(10)->get();
        $newsletter=Newsletter::where('id_user','=',auth::user()->id)->first();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Profil',
            'profil'    => $profil,
            'jumlahdonasi'=>$jumlahdonasi,
            'riwayat'=>$riwayat,
            'newsletter'=>$newsletter
        ], 200);
    }
}
