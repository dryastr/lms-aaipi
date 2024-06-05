<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    protected $table = 'product_orders';

    public $timestamps = false;

    protected $guarded = ['id'];

    public static $status = ['pending', 'waiting_delivery', 'shipped', 'success', 'canceled'];

    public static $waitingDelivery = 'waiting_delivery';

    public static $shipped = 'shipped';

    public static $success = 'success';

    public static $canceled = 'canceled';

    public static $pending = 'pending';

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function seller()
    {
        return $this->belongsTo('App\User', 'seller_id', 'id');
    }

    public function buyer()
    {
        return $this->belongsTo('App\User', 'buyer_id', 'id');
    }

    public function sale()
    {
        return $this->belongsTo('App\Models\Sale', 'sale_id', 'id');
    }

    public function gift()
    {
        return $this->belongsTo('App\Models\Gift', 'gift_id', 'id');
    }
}
