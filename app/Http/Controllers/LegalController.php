<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    public function mentions()
    {
        return view('legal.mentions');
    }
}

