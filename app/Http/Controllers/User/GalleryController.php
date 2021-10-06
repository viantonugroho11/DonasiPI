<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Artikel;
use App\Models\Gallery;
use App\Traits\KategoriNav;
class GalleryController extends Controller
{
    use KategoriNav;
    //
    public function index()
    {
        $kategori=$this->NavKategori();
        $artikel=Artikel::latest()->limit(2)->get();
        $gallery=Gallery::latest()->paginate(20);
        return view('user.gallery',compact(['kategori','artikel','gallery']));
    }
    public function gallerykategori($id)
    {
        $kategori=$this->NavKategori();
        $artikel=Artikel::latest()->limit(2)->get();
        $gallery=Gallery::where('kategori','=',$id)
        ->latest()->paginate(10);
        return view('user.home');
    }
    public function show($id)
    {
        $kategori=$this->NavKategori();
        $artikel=Artikel::latest()->limit(2)->get();
        $program=Program::where('id','=',$id)->first();
        return view('user.home');
    }
}
