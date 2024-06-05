<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Resources extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'user_id',
    //     'title',
    //     'seotitle',
    //     'description',
    //     'cover',
    //     'category_id',
    //     'type_other_category_id',
    //     'crosscom_tematik_other_category_id',
    //     'source',
    //     'filename',
    //     'size',
    //     'ext',
    //     'status',
    // ];

    protected $table = 'resources';

    protected $guarded = ['id'];

    public static $active = 'active';

    public static $pending = 'pending';

    public static $isDraft = 'is_draft';

    public static $inactive = 'inactive';

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::slug($value);
    }

    // public static $resourceSource = ['all', 'course', 'bundle', 'category', 'meeting', 'product'];

    /**
     * Get the category that owns the resource.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function filterOptions()
    {
        return $this->hasMany('App\Models\ResourceFilterOption', 'resource_id', 'id');
    }

    /**
     * Get the other category that owns the resource.
     */
    public function otherCategory()
    {
        return $this->belongsTo(CrossCompetency::class);
    }

    public function getUrl()
    {
        return url('/resources/'.$this->title);
        // return url('/resources/'.urlencode($this->title));
        // return url('/upcoming_courses/'.$this->slug);
    }

    public function getImageCover()
    {
        return $this->cover;
    }

    public function getImage()
    {
        return $this->cover;
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function isOwner($userId = null)
    {
        if (empty($userId)) {
            $userId = auth()->id();
        }

        return ($this->creator_id == $userId) or ($this->teacher_id == $userId);
    }

    public function sales()
    {
        return $this->hasMany('App\Models\Sale', 'resource_id', 'id')
            ->whereNull('refund_at')
            ->where('type', 'resource');
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\User', 'teacher_id', 'id');
    }

    // public function students()
    // {
    //     return $this->hasMany(Student::class, 'resource_id'); // Sesuaikan 'resource_id' dengan nama kolom kunci asing yang sesuai
    // }

    public function downloads()
    {
        return $this->hasMany(ResourcesDownload::class, 'resource_id');
    }
}
