<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heregistrasi extends Model
{
    use HasFactory;
    //Ngambil Table di db
    protected $table = 'db_heregistrasi';

    //kolom yang bisa diisi
    protected $fillable = [
        'alm_id',
        'registrasi_id',
        'nominal',
        'tanggal_heregistrasi'
    ];
}
