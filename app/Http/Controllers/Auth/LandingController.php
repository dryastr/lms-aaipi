<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Security;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LandingController extends Controller
{
    public function index(Request $request, $token)
    {
        // dd($token);
        try {

            $decryptedPayload = Security::decrypt($token);
            // $decryptedPayload = Crypt::decrypt($token);

            $decryptedEmail = $decryptedPayload['email'];
            $expirationTime = $decryptedPayload['lifetime'];
            $currentTime = now('Asia/Jakarta');

            if ($currentTime->lessThanOrEqualTo($expirationTime)) {
                $user = User::where('email', '=', $decryptedEmail)->first();

                if ($user) {
                    $user->is_member_aaipi = 1;
                    $user->save();
        
                    Auth::login($user);

                    if ($user?->isAdmin()) {
                        return redirect()->to(getAdminPanelUrl());
                    } else {
                        return redirect()->to('/panel');
                    }
                } else {
                    return redirect()->route('login')->with('error', 'Email tidak valid dari token.');
                }
            } else {
                return redirect()->route('login')->with('error', 'Waktu sesi login telah berakhir.');
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            \Log::error('Error Dekripsi: '.$e->getMessage());

            return redirect()->route('login')->with('error', 'Token tidak valid atau kesalahan dekripsi.');
        }
    }
}
