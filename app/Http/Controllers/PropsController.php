<?php

namespace App\Http\Controllers;

use App\Prop;

class PropsController extends Controller
{
    public function home()
    {
        $props = Prop::all();
    
        return view('welcome', [
            'props' => $props,
        ]);
    }
}
