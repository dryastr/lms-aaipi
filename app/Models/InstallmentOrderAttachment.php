<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallmentOrderAttachment extends Model
{
    protected $table = 'installment_order_attachments';

    public $timestamps = false;

    protected $guarded = ['id'];
}
