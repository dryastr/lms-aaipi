<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailVerificationNotifications extends Mailable
{
    use SerializesModels;

    public $notification;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $notification = $this->notification;
        // $generalSettings = getGeneralSettings();

        // return $this->subject($notification['title'])
        //     ->from(! empty($generalSettings['site_email']) ? $generalSettings['site_email'] : env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
        //     ->cc(! empty($notification['cc']) ? $notification['cc'] : [])
        //     ->view('web.default.emails.notification', [
        //         'notification' => $notification,
        //         'generalSettings' => $generalSettings,
        //     ]);

        $generalSettings = getGeneralSettings();
        $subject = trans('auth.email_confirmation');

        $confirm = [
            'title' => $subject.' '.trans('auth.in').' '.$generalSettings['site_name'],
            'message' => trans('auth.email_confirmation_template_body', ['email' => $notification->email, 'site' => $generalSettings['site_name']]),
            'code' => $notification->code,
        ];

        return $this->subject($subject)
            ->from(! empty($generalSettings['site_email']) ? $generalSettings['site_email'] : env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->view('web.default.emails.confirmCode', [
                'confirm' => $confirm,
                'generalSettings' => $generalSettings,
            ]);
    }
}
