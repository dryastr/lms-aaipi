<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetaProvinsi extends Model
{
    use HasFactory;

    protected $table = 'peta_propinsi';

    protected $fillable = [
        'mst_propinsi_id',
        'propinsi_name',
        'province_code',
        'shape',
    ];

    public function kabkota()
    {
        return $this->hasMany(PetaKabKota::class, 'mst_propinsi_id', 'mst_propinsi_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
