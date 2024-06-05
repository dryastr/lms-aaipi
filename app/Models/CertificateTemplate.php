<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class CertificateTemplate extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'certificates_templates';

    public $timestamps = false;

    protected $dateFormat = 'U';

    protected $guarded = ['id'];

    public $translatedAttributes = ['title', 'body'];

    public function getTitleAttribute()
    {
        return getTranslateAttributeValue($this, 'title');
    }

    public function getBodyAttribute()
    {
        return getTranslateAttributeValue($this, 'body');
    }

    public function getRtlAttribute()
    {
        return getTranslateAttributeValue($this, 'rtl');
    }
}
