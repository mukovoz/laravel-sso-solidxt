<?php

namespace Solidxt\SSO\Controller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;

class SSOController extends Controller
{
    public function callback(Request $request): mixed
    {

        $request->ip();
        $encrypter = new \Illuminate\Encryption\Encrypter(config('sso.secret_key'), config('app.cipher'));
        $hash = $request->get('hash');
        $decrypted = $encrypter->decryptString($hash);
        $data = json_decode($decrypted);

        $user = null;
        if (config('sso.user_create')) {
            $user = User::where('email', $data->email)->first();
            if (!$user) {
                $user = User::create([
                    'email' => $data->email,
                    'name' => $data->first_name . " " . $data->last_name,
                    'password' => Hash::make($data->email),
                    'email_verified_at' => Carbon::now(),
                ]);
            }
            \Illuminate\Support\Facades\Auth::loginUsingId($user[$user->getKeyName()]);
        }

        \Illuminate\Support\Facades\Auth::loginUsingId($user[$user->getKeyName()]);
        return redirect('/');
    }
}
