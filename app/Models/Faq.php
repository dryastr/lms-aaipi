<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'faqs';

    public $timestamps = false;

    protected $guarded = ['id'];

    public $translatedAttributes = ['title', 'answer'];

    public function getTitleAttribute()
    {
        return getTranslateAttributeValue($this, 'title');
    }

    public function getAnswerAttribute()
    {
        return getTranslateAttributeValue($this, 'answer');
    }
}
