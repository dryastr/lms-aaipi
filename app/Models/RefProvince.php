<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefProvince extends Model
{
    protected $table = 'ref_provinces';

    protected $fillable = ['province_name', 'code'];

    public function cities()
    {
        return $this->hasMany(RefCity::class, 'province_id');
    }
}
