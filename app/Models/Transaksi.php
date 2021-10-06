<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
            'orderid'
            ,'transaksiid'
            ,'id_program'
            ,'id_user'
            ,'nama'
            ,'tipe'
            ,'pesan'
            ,'nominal'
            ,'status'
            ,'jenis'
    ];
    public function programis()
    {
        return $this->hasMany(Program::class);
    }
}
