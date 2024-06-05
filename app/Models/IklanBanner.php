<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IklanBanner extends Model
{
    use HasFactory;

    protected $table = 'iklan_banner';

    protected $fillable = [
        'title',
        'image',
        'url',
        'target'
    ];
}
