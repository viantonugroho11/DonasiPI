<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    //
    public function index()
    {
        $event=Event::latest()->paginate(12);
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Donasi',
            'data'    => $event
        ], 200);
    }
    public function indexevent()
    {
        $event=Event::latest()->paginate(12);
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Donasi',
            'data'    => $gallery
        ], 200);
    }
    public function show($id)
    {
        $event=Event::where('id','=',$id)->first();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Donasi',
            'data'    => $event
        ], 200);
    }
}
