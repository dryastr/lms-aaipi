<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    public $timestamps = false;

    protected $dateFormat = 'U';

    protected $guarded = ['id'];

    protected $fillable = ['name', 'email', 'phone', 'subject', 'message', 'termsconditions', 'created_at'];
}
