<?php

namespace App\Http\Controllers;

use App\Org;
use App\Utils;
use Illuminate\Http\Request;

class OrgController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Org  $org
     * @return \Illuminate\Http\Response
     */
    public function show(Org $org)
    {
        return view('org', [
            'org' => $org,
            'childrenOrgs' => $org->children,
            'childrenProps' => $org->props,
            'a11yScore' => $org->getA11yScore(),
            'uptimeScore' => $org->getUptimeScore(),
            'utils' => new Utils
        ]);
    }
}
