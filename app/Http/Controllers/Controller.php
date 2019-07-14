<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Org;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home()
    {
        $rootOrg = Org::withDepth()->having('depth', '=', 0)->get()->first();
        $topLevelOrgs = Org::withDepth()->having('depth', '=', 1)->get();

        $topLevelProps = [];

        if ($rootOrg->props()->count() > 0) {
            $topLevelProps = $rootOrg->props();
        }

        return view('welcome', [
            'topLevelOrgs' => $topLevelOrgs,
            'topLevelProps' => $topLevelProps
        ]);
    }
}
