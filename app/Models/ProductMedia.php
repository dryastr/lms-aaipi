<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model
{
    protected $table = 'product_media';

    public $timestamps = false;

    protected $dateFormat = 'U';

    protected $guarded = ['id'];

    public static $types = ['thumbnail', 'image', 'video'];

    public static $thumbnail = 'thumbnail';

    public static $image = 'image';

    public static $video = 'video';

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
}
