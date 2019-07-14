<?php

namespace App\Http\Controllers;

use App\Prop;

class PropController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Org  $org
     * @return \Illuminate\Http\Response
     */
    public function show(Prop $prop)
    {
        return view('prop', [
            'prop' => $prop
        ]);
    }


}
