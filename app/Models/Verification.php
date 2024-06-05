<?php

namespace App\Models;

use App\Notifications\SendVerificationSMSCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Verification extends Model
{
    use Notifiable;

    protected $table = 'verifications';

    public $timestamps = false;

    protected $dateFormat = 'U';

    protected $guarded = ['id'];

    const EXPIRE_TIME = 3600; // second => 1 hour

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function sendEmailCode()
    {
        \App\Jobs\SendEmailVerification::dispatch($this->email, $this);
    }

    public function sendSMSCode()
    {
        try {
            $this->notify(new SendVerificationSMSCode($this));
        } catch (\Throwable $ex) {
            //
        }
    }
}
