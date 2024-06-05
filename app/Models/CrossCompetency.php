<?php

namespace App\Models;

use App\Models\Api\User;
// use App\Models\CrossCompetency;
use Illuminate\Database\Eloquent\Model;

class CrossCompetency extends Model
{
    protected $table = 'other_categories';

    protected $fillable = [
        'parent_id',
        'name',
        'types',
        'created_at',
        'creator_id',
    ];

    public static $cacheKey = 'categories';

    public static $crosscomtypes = ['crosscom', 'type', 'thematic'];

    public $timestamps = false;

    public function subCategories()
    {
        return $this->hasMany(CrossCompetency::class, 'parent_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function webinars()
    {
        return Webinar::where('other_category_id', $this->id);
    }

    public function resources()
    {
        return Resources::where('crosscom_tematik_other_category_id', $this->id);
    }
}
