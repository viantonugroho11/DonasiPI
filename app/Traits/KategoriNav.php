<?php
namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\Kategori;

trait KategoriNav
{
    public function NavKategori()
    {
        return Kategori::latest()->limit(4)->get();
    }
}
