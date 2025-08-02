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
    
    private static function uploadImage($request){
       $path = $request->profile->store('profiles', 'public');
       return asset($path);
    }
    public function login(LoginRequest $request)
    {
        $find = User::where('phone', $request->phone)->first();

        if(! empty($find)){
            if (! Auth::attempt($request->only('phone', 'password')))
            {
                return Inertia::render('app', [], 401);
            }
      

        $request->session()->regenerate();

        Log::channel('login')->info('یوزر لاگین کرد!', [
            'user_id' => auth()->id(),
            'email' => auth()->user()->phone,
            'ip' => $request->ip(),
        ]);

        return Inertia::render('app');
        }

        session(['phone' => $request->phone]);
        session(['password' => $request->password]);

        return Inertia::render('app');
    }
    public function register(RegisterRequest $request)
    {
        $profile_url = self::uploadImage($request);

        $user = User::create_user($request, $profile_url, session('phone'), session('password'));

        Log::channel('register')->info('یوزر جدید ثبت نام کرد', [
            'user_id' => $user->id,
            'phone' => $user->phone,
            'ip' => $request->ip(),
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        // welcomJob::dispatch($user)->onQueue('email');

        return Inertia::render('app');
    }
    public function logout(){
       $user = [
          'id' => auth()->id(),
          'phone' => auth()->user()->phone,
          'ip' => request()->ip()
       ];
        
       Auth::logout();

       Log::channel('logout')->info('یوزر خارج شد', [
            'user_id' => $user["id"],
            'phone' => $user["phone"],
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
