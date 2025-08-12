<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\OtpRequest;
use App\Http\Requests\registerRequest;
use App\Jobs\welcomJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class authController extends Controller
{
    public function index()
    {
        return Inertia::render('app');
    }
    
    private function uploadImage($request){
       try{
        $path = $request->profile->store('profiles', 'public');
       return asset($path);
       }catch(\Exception $e){
        return;
       }
    }
    public function login(LoginRequest $request)
    {
        $find = User::where('phone', $request->phone)->first();

        if(empty($find)){
            session(['phone' => $request->phone]);
            session(['password' => $request->password]);
            exit;
        }            

        if (! Auth::attempt($request->only('phone', 'password')))
        {
            return response()->json([], 401);        
        }    
      
        $request->session()->regenerate();

        Log::channel('login')->info('یوزر لاگین کرد!', [
            'user_id' => auth::id(),
            'email' => Auth::user()->phone,
            'ip' => $request->ip(),
        ]);

    
        return response()->json(['name' => $find->name]);
    }
    public function register(RegisterRequest $request)
    {
        $profile_url = $this->uploadImage($request);

        $user = User::create_user($request, $profile_url, session('phone'), session('password'));

        Log::channel('register')->info('یوزر جدید ثبت نام کرد', [
            'user_id' => $user->id,
            'phone' => $user->phone,
            'ip' => $request->ip(),
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        // welcomJob::dispatch($user)->onQueue('email');

        return response()->json(['name' => $user->name]);
    }
    public function logout(){
       $user = [
          'id' => Auth::id(),
          'phone' => Auth::user()->phone,
          'ip' => request()->ip()
       ];
        
       Auth::logout();

       Log::channel('logout')->info('یوزر خارج شد', [
            'user_id' => $user["id"],
            'phone' => $user["phone"],
            'ip' => $user["ip"]
       ]);
    }
    public function otp_generate(OtpRequest $request)
    {
        $otp = random_int(10000, 99999);
        session(['otp' => $otp]);
        session('phone', $request->phone);
        return response()->json(['otp' => $otp]);
    }
    public function otp_check(OtpRequest $request)
    {
        if(session('otp') !== $request->otp){
            return response()->json([], 401);
        }
        $user = User::findByPhone(session('phone'));
        if (!$user)
        {
            return response()->json([], 401);        
        }  
        Auth::login($user);  
    }
}
