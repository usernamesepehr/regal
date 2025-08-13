<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class adminLoginController extends Controller
{
    public function index()
    {
        return Inertia::render('app');
    }
    public function login(Request $request)
    {
        if ($request->role !== Auth::user()->role){
            return response()->json([], 403);
        }

        session(['role' => $request->role]);
    }
}
