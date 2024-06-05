<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceFilterOption extends Model
{
    protected $table = 'resource_filter_option';

    public $timestamps = false;

    protected $guarded = ['id'];
}
