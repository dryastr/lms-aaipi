<?php

namespace App\Jobs\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Logout implements ShouldQueue
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
        public $data,
    ) {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = \DB::table('users')->where('ref_user_id', $this->data['user_id'])->first();
        if ($user) {
            \DB::table('auto_logouts')
                ->updateOrInsert([
                    'user_id' => $user->id,
                ], [
                    'logout_at' => $this->data['logout_at'],
                ]);
        }
    }
}
