<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable = [
    'nama'
    ,'detail'
    ,'detail_singkat'
    ,'id_kategori'
    ,'batas'
    ,'nominal'
    ,'foto'
    ];



    public function getTransaksi()
    {
        return $this->HasMany(Transaksi::class,'id_program');
    }
    public function getTransaksiAll()
    {
        return $this->BelongsToMany(Transaksi::class,'Transaksis.id_program');
    }
}
