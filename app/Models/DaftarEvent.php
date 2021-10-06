<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarEvent extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_user'
        ,'nama'
        ,'email'
        ,'nohp'
        ,'id_event'
    ];
}
