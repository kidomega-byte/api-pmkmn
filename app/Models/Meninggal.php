<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meninggal extends Model
{
    use HasFactory;

    //Ngambil Table di db
    protected $table = 'db_meninggal';

    //kolom yang bisa diisi
    protected $fillable = [
        'tempat_meninggal',
        'pemakaman_id',
        'alm_id',
        'tanggal_meninggal'
    ];
}
