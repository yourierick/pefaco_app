<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicSpaceController extends Controller
{
    public function home()
    {
        return view('public_layouts.index');
    }
}
