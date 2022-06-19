<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alm extends Model
{
    use HasFactory;
    protected $table = 'db_alm';
    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'gender',
        'tempat_lahir',
        'tanggal_lahir',
        'meninggal_id',
        'agama'
    ];

    /**
     * Get the user associated with the Alm
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ahliwaris()
    {
        return $this->hasOne(Ahliwaris::class, 'id', 'ahliwaris_id');
    }
}
