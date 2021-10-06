<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Program;
use App\Models\User;
use App\Models\Event;
// use App\Models\Tabungan;
use Auth;
use Carbon\Carbon;
class HomeController extends Controller
{
    //
    public function index()
    {
        $jmldonasi=Transaksi::where('status','=','settlement')->where('jenis','=','Donasi')->sum('nominal');
        // dd($jmldonasi);
        $jmlprogram=Program::count();
        $jmldonatur=User::count();
        $jmlevent=Event::count();
        $jmlprogramaktif=Program::where('batas','>=',Carbon::now()->format('Y/m/d'))->count();
        $jmldonasihariini=Transaksi::where('updated_at','=',now())->where('status','=','settlement')->where('jenis','=','Donasi')->sum('nominal');
        return view('admin.dashboard',compact(['jmldonasi','jmlprogram','jmldonatur','jmlevent'
        ,'jmlprogramaktif','jmldonasihariini']));
    }
}
