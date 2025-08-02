<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\registerRequest;
use App\Jobs\welcomJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class authController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $profile_url = self::uploadImage($request);

        $user = User::create_user($request, $profile_url);

        Log::channel('register')->info('یوزر جدید ثبت نام کرد', [
            'user_id' => $user->id,
            'email' => $user->email,
            'ip' => $request->ip(),
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        welcomJob::dispatch($user)->onQueue('email');

        return Inertia::render('app');
    }
    private static function uploadImage($request){
       $path = $request->profile->store('profiles', 'public');
       return asset($path);
    }
    public function login(LoginRequest $request)
    {
        if (! Auth::attempt($request->only('email', 'password')))
        {
            return Inertia::render('app', [], 401);
        }

        $request->session()->regenerate();

        Log::channel('login')->info('یوزر لاگین کرد!', [
            'user_id' => auth()->id(),
            'email' => auth()->user()->email,
            'ip' => $request->ip(),
        ]);

        return Inertia::render('app');
    }
    public function logout(){
       $user = [
          'id' => auth()->id(),
          'email' => auth()->id(),
          'ip' => request()->ip()
       ];
        
       Auth::logout();

       Log::channel('logout')->info('یوزر خارج شد', [
            'user_id' => $user["id"],
            'email' => $user["email"],
            'ip' => $user["ip"]
       ]);

       return Inertia::render('app');
    }
    public function otp_generate()
    {
        $otp = random_int(10000, 99999);
        session(['otp' => $otp]);
        return Inertia::render('app', [
            "password" => $otp
        ]);
    }
}
