<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $active = 'dashboard';
        return view('admin.home.dashboard', compact('active'));
    }
}
