<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blok extends Model
{
    use HasFactory;

    //Ngambil Table di db
    protected $table = 'db_blok';

    //kolom yang bisa diisi
    protected $fillable = [
        'nama_blok',
        'nomor',
        'posisi'
    ];
}
