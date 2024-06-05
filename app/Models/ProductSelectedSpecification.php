<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ProductSelectedSpecification extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'product_selected_specifications';

    public $timestamps = false;

    protected $guarded = ['id'];

    public static $inputTypes = ['textarea', 'multi_value'];

    public static $Active = 'active';

    public static $Inactive = 'inactive';

    public static $itemsStatus = ['active', 'inactive'];

    public $translatedAttributes = ['value'];

    public function getValueAttribute()
    {
        return getTranslateAttributeValue($this, 'value');
    }

    public function specification()
    {
        return $this->belongsTo('App\Models\ProductSpecification', 'product_specification_id', 'id');
    }

    public function selectedMultiValues()
    {
        return $this->hasMany('App\Models\ProductSelectedSpecificationMultiValue', 'selected_specification_id', 'id');
    }
}
