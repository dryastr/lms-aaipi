<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetaKabKota extends Model
{
    use HasFactory;

    protected $table = 'peta_kabkota';

    protected $fillable = [
        'mst_kabupaten_id',
        'mst_propinsi_id',
        'propinsi_name',
        'kabupaten_name',
        'alias',
        'province_code',
        'city_code',
        'shape',
    ];

    public function propinsi()
    {
        return $this->belongsTo(PetaProvinsi::class, 'mst_propinsi_id', 'mst_propinsi_id');
    }

    public function users()
    {
        return $this->hasMany('App\User', 'city_code', 'city_code');
    }
}
