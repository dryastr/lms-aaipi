<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefCity extends Model
{
    protected $table = 'ref_city';

    protected $fillable = ['city_name', 'province_id', 'code'];

    public function province()
    {
        return $this->belongsTo(RefProvince::class, 'province_id');
    }
}
