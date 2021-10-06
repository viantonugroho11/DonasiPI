<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Artikel;
use App\Models\Newsletter;
use App\Models\Event;
use App\Models\DaftarEvent;
use App\Traits\KategoriNav;
use Auth;
use Carbon\Carbon;
class EventController extends Controller
{
    use KategoriNav;
    //
    public function index()
    {
        $kategori=$this->NavKategori();
        $artikel=Artikel::latest()->limit(2)->get();
        $event=Event::where('batas_tanggal','>=',Carbon::now()->format('Y/m/d'))->latest()->paginate(12);
        return view('user.event.index',compact(['kategori','artikel','event']));
    }
    public function artkelkategori($id)
    {
        $kategori=$this->NavKategori();
        $artikel=Artikel::latest()->limit(2)->get();
        $program=Event::where('kategori','=',$id)
        ->paginate(10)->get();
        return view('user.home');
    }
    public function show($id)
    {
        $kategori=$this->NavKategori();
        $artikel=Artikel::latest()->limit(2)->get();
        $event=Event::where('id','=',$id)->first();
        if(Auth::check()){
        $daftarevent=DaftarEvent::where('id_user','=',Auth::user()->id)
        ->where('id_event','=',$id)->first();
        }
        return view('user.event.show',compact(['kategori','artikel','event']));
    }
    public function store(Request $request)
    {
        $url=url()->previous();
        if(Auth::check())
        {
            $cek=DaftarEvent::where('id_user','=',Auth::user()->id)->first();
            if(!$cek){
                // return
                $daftar=DaftarEvent::create([
                    'id_user'     => Auth::user()->id,
                    'nama'     => Auth::user()->name,
                    'email'     => Auth::user()->email,
                    'nohp'     => Auth::user()->nohp,
                    'id_event'     => $request->id_event
                ]);
                $kategori=$this->NavKategori();
                $artikel=Artikel::latest()->limit(2)->get();
                $event=Event::where('id','=',$request->id_event)->first();
                return view('user.event.show',compact(['kategori','artikel','event']));
            }
            else
            //kebambalikan ke event
            {
                $kategori=$this->NavKategori();
                $artikel=Artikel::latest()->limit(2)->get();
                $event=Event::where('id','=',$request->id_event)->first();
                return view('user.event.show',compact(['kategori','artikel','event']));
            }
        }
        else
        {
            $cek=DaftarEvent::where('email','=',$request->email)->first();
            if(!$cek){
                // return
                $daftar=DaftarEvent::create([
                    'nama'     => $request->nama,
                    'email'     => $request->email,
                    'nohp'     => $request->nohp,
                    'id_event'     => $request->id_event
                ]);
                $kategori=$this->NavKategori();
                $artikel=Artikel::latest()->limit(2)->get();
                $event=Event::where('id','=',$request->id_event)->first();
                return view('user.event.show',compact(['kategori','artikel','event']));
            }
            else
            {
                $kategori=$this->NavKategori();
                $artikel=Artikel::latest()->limit(2)->get();
                $event=Event::where('id','=',$request->id_event)->first();
                return view('user.event.show',compact(['kategori','artikel','event']));
            }
        }
    }
}
