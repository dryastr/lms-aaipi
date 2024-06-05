<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSelectedBankSpecification extends Model
{
    protected $table = 'user_selected_bank_specifications';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function bankSpecification()
    {
        return $this->belongsTo('App\Models\UserBankSpecification', 'user_bank_specification_id', 'id');
    }
}
