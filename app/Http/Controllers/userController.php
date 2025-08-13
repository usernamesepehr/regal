<?php

namespace App\Http\Controllers;

use App\Http\Requests\userUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class userController extends Controller
{
    public function get_info()
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $userData = collect($user)->except('id', 'role', 'created_at', 'updated_at');
        return response()->json($userData);
    }
    public function update_info(userUpdateRequest $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        if ($request->profile){
            $path = '/profiles'. "/" . $user->profile;
            Storage::disk('public')->delete($path);
            $profilePath = $request->profile->store('profiles', 'public');
            $user->profile = $profilePath;
            $user->save();
        }

        $user->update($request->except('profile', 'phone', 'id', 'role', 'created_at', 'updated_at'));  
    }
}
