<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    protected $fillable = [
    'nama'
    ,'id_kategori'
    ,'id_admin'
    ,'detail'
    ,'detail_singkat'
    ,'foto'
    ];
}
