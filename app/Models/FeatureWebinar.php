<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class FeatureWebinar extends Model implements TranslatableContract
{
    use Translatable;

    protected $dateFormat = 'U';

    public $timestamps = false;

    protected $guarded = ['id'];

    protected $table = 'feature_webinars';

    public static $pages = ['categories', 'home', 'home_categories'];

    public $translatedAttributes = ['description'];

    public function getDescriptionAttribute()
    {
        return getTranslateAttributeValue($this, 'description');
    }

    public function webinar()
    {
        return $this->belongsTo('App\Models\Webinar', 'webinar_id', 'id');
    }
}
