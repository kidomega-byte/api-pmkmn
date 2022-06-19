<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemakaman extends Model
{
    use HasFactory;

    //Ngambil Table di db
    protected $table = 'db_pemakaman';

    //kolom yang bisa diisi
    protected $fillable = [
        'nama_pkm',
        'alamat',
        'blok_id'
    ];
}
