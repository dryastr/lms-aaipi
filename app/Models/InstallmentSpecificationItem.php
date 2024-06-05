<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallmentSpecificationItem extends Model
{
    protected $table = 'installment_specification_items';

    public $timestamps = false;

    protected $guarded = ['id'];
}
