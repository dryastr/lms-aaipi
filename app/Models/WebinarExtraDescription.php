<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class WebinarExtraDescription extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'webinar_extra_descriptions';

    public $timestamps = false;

    protected $guarded = ['id'];

    public static $types = ['learning_materials', 'company_logos', 'requirements'];

    public static $LEARNING_MATERIALS = 'learning_materials';

    public static $COMPANY_LOGOS = 'company_logos';

    public static $REQUIREMENTS = 'requirements';

    public $translatedAttributes = ['value'];

    public function getValueAttribute()
    {
        return getTranslateAttributeValue($this, 'value');
    }
}
