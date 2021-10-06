<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable=[
        'nama'
        ,'detail'
        ,'tanggal_pelaksana'
        ,'batas_tanggal'
        ,'batas_peserta'
        ,'foto'
    ];

    public function getDaftarEvent()
    {
        return $this->HasMany(DaftarEvent::class,'id_event');
    }
}
