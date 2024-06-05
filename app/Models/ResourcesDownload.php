<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourcesDownload extends Model
{
    use HasFactory;

    protected $table = 'resources_download';

    protected $fillable = [
        'user_id',
        'resource_id',
        'download_count',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    protected $guarded = ['id'];

    // Mendefinisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mendefinisikan relasi dengan model Resources
    public function resource()
    {
        return $this->belongsTo(Resources::class);
    }

    public function downloads()
    {
        return $this->hasMany(ResourcesDownload::class, 'resource_id');
    }

    public function UserDownloads()
    {
        return $this->hasMany(ResourcesDownload::class, 'user_id', 'id');
    }
}
