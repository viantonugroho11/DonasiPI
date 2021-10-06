<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    //
    public function index()
    {
        $gallery=Gallery::latest()->get();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Donasi',
            'data'    => $gallery
        ], 200);
    }
    public function indexgallery()
    {
        $gallery=Gallery::where('kategori','=',$id)
        ->latest()->paginate(10);
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Donasi',
            'data'    => $gallery
        ], 200);
    }
}
