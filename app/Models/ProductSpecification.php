<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'product_specifications';

    public $timestamps = false;

    protected $dateFormat = 'U';

    protected $guarded = ['id'];

    public static $inputTypes = ['textarea', 'multi_value'];

    public $translatedAttributes = ['title'];

    public function getTitleAttribute()
    {
        return getTranslateAttributeValue($this, 'title');
    }

    public function categories()
    {
        return $this->hasMany('App\Models\ProductSpecificationCategory', 'specification_id', 'id');
    }

    public function multiValues()
    {
        return $this->hasMany('App\Models\ProductSpecificationMultiValue', 'specification_id', 'id');
    }

    public function createName()
    {
        return str_replace(' ', '_', $this->title);
    }
}
