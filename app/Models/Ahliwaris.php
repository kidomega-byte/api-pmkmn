<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ahliwaris extends Model
{
    use HasFactory;
    protected $table = 'db_ahliwaris';
    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'gender',
        'tanggal_lahir',
        'hubungan',
        'alm_id',
        'agama'
    ];


    /**
     * Get all of the comments for the Ahliwaris
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alm()
    {
        return $this->hasMany(Alm::class, 'id', 'alm_id');
    }
}
