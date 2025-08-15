<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class applyController extends Controller
{
    public function index()
    {
        return Inertia::render('app');
    }
    public function create()
    {
        
    }
}
