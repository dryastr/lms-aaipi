<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallmentReminder extends Model
{
    protected $table = 'installment_reminders';

    public $timestamps = false;

    protected $guarded = ['id'];
}
