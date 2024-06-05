<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCookieSecurity extends Model
{
    protected $table = 'users_cookie_security';

    public $timestamps = false;

    protected $guarded = ['id'];

    public static $types = ['all', 'customize'];

    public static $ALL = 'all';

    public static $CUSTOMIZE = 'customize';
}
