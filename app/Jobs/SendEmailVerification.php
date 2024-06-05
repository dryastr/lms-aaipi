<?php

namespace App\Jobs;

use App\Helpers\Constants\Queue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailVerification implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public $email,
        public $data
    ) {
        $this->queue = Queue::SEND_EMAIL;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            \Mail::to($this->email)->send(new \App\Mail\SendEmailVerificationNotifications($this->data));
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
