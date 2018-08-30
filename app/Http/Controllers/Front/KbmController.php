<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KbmController extends Controller
{
    public function index()
    {
        return view('front.kbm');
    }
}
