<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashbackRuleSpecificationItem extends Model
{
    protected $table = 'cashback_rule_specification_items';

    public $timestamps = false;

    protected $guarded = ['id'];
}
