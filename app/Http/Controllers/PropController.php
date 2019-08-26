<?php

namespace App\Http\Controllers;

use App\Prop;
use App\Utils;

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
        $isPropUp = $prop->monitor->uptime_status == 'up' ? '1' : '0';

        return view('prop', [
            'prop' => $prop,
            'isPropUp' => $isPropUp,
            'utils' => new Utils
        ]);
    }


}
