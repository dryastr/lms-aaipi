<?php

namespace App\Jobs\Sync;

use App\User as UserModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;

class User implements ShouldQueue
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
        public $type = null
    ) {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->type === 'sync') {
            foreach ($this->data as $data) {
                $this->execute($data);
            }
        } else {
            $this->execute($this->data);
        }
    }

    public function execute($data): void
    {
        if (is_object($data)) {
            $data = (array) $data;
        }
        if ($data['action'] === 'deleted') {
            UserModel::where([
                'ref_user_id' => $data['id'],
            ])->delete();
        } else {
            $payload = Arr::only($data, [
                'email',
                'password',
                'mobile',
                'status',
                'created_at',
                'updated_at',
            ]);
            $payload['full_name'] = $data['fullname'];
            $payload['ref_user_id'] = $data['id'];

            if (isset($data['email_verified_at'])) {
                $payload['verified'] = 1;
            }

            $payload['created_at'] = strtotime($payload['created_at']);
            $payload['updated_at'] = strtotime($payload['updated_at']);
            $payload['is_member_aaipi'] = true;

            if (isset($data['role_id'])) {
                // if ($data['role_id'] == 2) {
                //     $payload['role_name'] = 'anggota_biasa';
                //     $payload['role_id'] = 4;
                // } elseif ($data['role_id'] == 3) {
                //     $payload['role_name'] = 'anggota_luar_biasa';
                //     $payload['role_id'] = 7;
                // } elseif ($data['role_id'] == 4) {
                //     $payload['role_name'] = 'anggota_kehormatan';
                //     $payload['role_id'] = 8;
                // } else {
                //     $payload['role_name'] = 'admin';
                //     $payload['role_id'] = 1;
                // }
                $payload['role_name'] = 'user';
                $payload['role_id'] = 1;
            }

            // 4 # Anggota Biasa | anggota_biasa
            // 7 # Anggota Luar Biasa | anggota_luar_biasa
            // 8 # Anggota Kehormatan | anggota_kehormatan

            UserModel::updateOrCreate(['ref_user_id' => $data['id']], $payload);
        }
    }
}
